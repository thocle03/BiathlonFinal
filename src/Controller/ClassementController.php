<?php

namespace App\Controller;

use App\Entity\Classement;
use App\Form\ClassementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


class ClassementController extends AbstractController
{

    #[Route('/classement/create', name: 'test')]
    public function create(Request $request)
    {
        $classement = new Classement();
        $form = $this->createForm(ClassementType::class, $classement);
        $form->handleRequest($request);

        return $this->render("classement/create.html.twig", [
            "formulaire" => $form->createView()
        ]);
    }

    #[Route("/classement/update/{id}")]
    public function update(Request $request, ManagerRegistry $doctrine, Classement $classement)
    {
        dump($classement);
        $form = $this->createForm(ClassementType::class, $classement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager(); // Récupération de l'EM
            $em->flush(); // Synchronisation avec la BDD 
        }
        return $this->render("classement/form.html.twig", [
            "form" => $form->createView()
        ]);
    }

    #[Route("/classement/delete/{id}")]
    public function delete(ManagerRegistry $doctrine, Classement $classement)
    {
        $em = $doctrine->getManager(); // Récupération de l'EM
        $em->remove($classement); // Suppression de l'objet dans l'EM
        $em->flush(); // Synchronisation avec la BDD    
        return $this->redirectToRoute("classement_readAll");
    }

    #[Route("/classement/read/{id}")]
    public function read(ManagerRegistry $doctrine, int $id)
    {
        $classementRepository = $doctrine->getRepository(Classement::class);
        $classement = $classementRepository->find($id);
        return $this->render("classement/read.html.twig", [
            "classement" => $classement
        ]);
    }

    #[Route("/classement/readAll")]
    public function readAll(ManagerRegistry $doctrine)
    {
        $classementRepository = $doctrine->getRepository(Classement::class);
        return $this->render("classement/read.html.twig", [
            "lists" => $classementRepository->findAll()
        ]);
    }
}
