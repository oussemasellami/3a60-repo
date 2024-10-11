<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    #[Route('/showblog', name: 'app_showblog')]
    public function showblog(): Response
    {
        return $this->render('blog/showblog.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    #[Route('/showparam', name: 'app_showparam')]
    public function showparam(): Response
    {

        $name = "bonjour";
        return $this->render('blog/showparam.html.twig', [
            'nameparam' => $name,
        ]);
    }

    #[Route('/showbyid/{id}', name: 'app_showbyid')]
    public function showbyid($id): Response
    {

        //var_dump($id);
        $mat="gt123";
        return $this->render('blog/showbyid.html.twig', [
            'idname' => $id,
            'matgt'=>$mat
        ]);
    }
}