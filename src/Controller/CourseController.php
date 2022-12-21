<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CourseController extends AbstractController
{
    #[Route("/", name: "index")]
    public function index(ManagerRegistry $doctrine)
    {
        $courses = $doctrine->getRepository(Course::class)->findAll();
        return $this->render("course/index.html.twig", [
            "courses" => $courses
        ]);
    }

    #[Route('/course/create', name: 'course_create')]
    public function new(Request $request, SluggerInterface $slugger, ManagerRegistry $doctrine)
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                dump($newFilename);
                $course->setImage($newFilename);
            }

            // ... persist the $product variable or any other work
            $em = $doctrine->getManager();
            $em->persist($course);
            $em->flush();

            //return $this->redirectToRoute('app_product_list');
        }

        return $this->render("course/create.html.twig", [
            "formulaire" => $form->createView()
        ]);
    }

    #[Route("/course/update/{id}")]
    public function update(Request $request, ManagerRegistry $doctrine, Course $course)
    {
        dump($course);
        $form = $this->createForm(courseType::class, $course);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager(); // Récupération de l'EM
            $em->flush(); // Synchronisation avec la BDD 
        }
        return $this->render("course/update.html.twig", [
            "form" => $form->createView()
        ]);
    }

    #[Route("/course/delete/{id}")]
    public function delete(ManagerRegistry $doctrine, Course $course)
    {
        $em = $doctrine->getManager(); // Récupération de l'EM
        $em->remove($course); // Suppression de l'objet dans l'EM
        $em->flush(); // Synchronisation avec la BDD    
        return $this->redirectToRoute("index");
    }

    #[Route("/course/read/{id}")]
    public function read(ManagerRegistry $doctrine, int $id)
    {
        $courseRepository = $doctrine->getRepository(Course::class);
        $course = $courseRepository->find($id);
        return $this->render("course/read.html.twig", [
            "course" => $course
        ]);
    }

    #[Route("/course/readAll")]
    public function readAll(ManagerRegistry $doctrine)
    {
        $courseRepository = $doctrine->getRepository(Course::class);
        return $this->render("course/read.html.twig", [
            "lists" => $courseRepository->findAll()
        ]);
    }
}
