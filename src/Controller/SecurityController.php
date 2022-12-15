<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\String\Slugger\SluggerInterface;

class SecurityController extends AbstractController
{
    #[Route("/login", name: "login")]
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();
        return $this->render("user/login.html.twig", [
            "error" => $error,
            "last_username" => $lastUsername
        ]);
        dump($lastUsername);
    }
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    #[Route("/logout", name: "logout")]
    public function logout()
    {
        //return $this->red
    }

    #[Route("/signup", name: "signup")]
    public function create(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $user = new User($this->passwordHasher);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($request);
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
                $user->setImage($newFilename);
            }

            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('login');
            
        }
        return $this->render('security/signup.html.twig', ["form" => $form->createView()]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => User::class
        ]);
    }

    #[Route("/user/readAll")]
    public function readAll(ManagerRegistry $doctrine)
    {
        $userRepository = $doctrine->getRepository(User::class);
        return $this->render("user/readAll.html.twig", [
            "users" => $userRepository->findAll()
        ]);
    }
    
    #[Route("/user/view/{id}")]
    public function read(ManagerRegistry $doctrine, int $id)
    {
        $userRepository = $doctrine->getRepository(User::class);
        $user = $userRepository->find($id);
        return $this->render("user/view.html.twig", [
            "user" => $user
        ]);
    }
    #[Route("/user/update/{id}")]
    public function update(Request $request, ManagerRegistry $doctrine, User $user)
    {
        dump($user);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager(); // Récupération de l'EM
            $em->flush(); // Synchronisation avec la BDD 
        }
        return $this->render("user/readAll.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
