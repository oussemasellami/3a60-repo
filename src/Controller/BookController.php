<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/showbook', name: 'app_showbook')]
    public function showbook(BookRepository $bookRepository): Response
    {
        $book = $bookRepository->findAll();
        return $this->render('book/showbook.html.twig', [
            'tabbook' => $book,
        ]);
    }


    #[Route('/addformbook', name: 'app_addformbook')]
    public function addformbook(ManagerRegistry $m, Request $req): Response
    {
        $em = $m->getManager();
        $author = new Book();
        $form = $this->createForm(BookType::class, $author);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute('app_showbook');
        }
        return $this->render('book/addformbook.html.twig', [
            'addform' => $form,
        ]);
    }



    #[Route('/deletebook/{id}', name: 'app_deletebook')]
    public function deletebook(ManagerRegistry $m, $id, BookRepository $rep): Response
    {
        $em = $m->getManager();
        $b = $rep->find($id);
        $em->remove($b);
        $em->flush();
        return $this->redirectToRoute('app_showbook');
    }
}
