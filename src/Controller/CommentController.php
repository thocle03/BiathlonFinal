<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CommentController extends AbstractController
{
    #[Route("/blabla")]
    public function index(ManagerRegistry $doctrine)
    {
        $comments =  $doctrine->getRepository(Comment::class)->findAll();

        return $this->render("comment/index.html.twig", [
            "comments" => $comments
        ]);
    }

    #[Route('/comment/create', name: 'comment_create')]
    public function new(Request $request, SluggerInterface $slugger, ManagerRegistry $doctrine)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);


        return $this->render("comment/create.html.twig", [
            "formulaire" => $form->createView()
        ]);
    }

    #[Route("/comment/update/{id}")]
    public function update(Request $request, ManagerRegistry $doctrine, Comment $comment)
    {
        dump($comment);
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager(); // Récupération de l'EM
            $em->flush(); // Synchronisation avec la BDD 
        }
        return $this->render("comment/form.html.twig", [
            "form" => $form->createView()
        ]);
    }

    #[Route("/comment/delete/{id}")]
    public function delete(ManagerRegistry $doctrine, Comment $comment)
    {
        $em = $doctrine->getManager(); // Récupération de l'EM
        $em->remove($comment); // Suppression de l'objet dans l'EM
        $em->flush(); // Synchronisation avec la BDD    
        return $this->redirectToRoute("index");
    }

    #[Route("/comment/read/{id}")]
    public function read(ManagerRegistry $doctrine, int $id)
    {
        $commentRepository = $doctrine->getRepository(Comment::class);
        $comment = $commentRepository->find($id);
        return $this->render("comment/read.html.twig", [
            "comment" => $comment
        ]);
    }

    #[Route("/comment/readAll")]
    public function readAll(ManagerRegistry $doctrine)
    {
        $commentRepository = $doctrine->getRepository(Comment::class);
        return $this->render("comment/read.html.twig", [
            "lists" => $commentRepository->findAll()
        ]);
    }
}
