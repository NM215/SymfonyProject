<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function accueil(){
        return $this->render('home/accueil.html.twig');
    }

    /**
     * @Route("/home", name="home")
     */
    public function index(PostRepository $ripo)
    {
        $posts = $ripo->findAll();

        return $this->render('home/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/posts/{id}", name="lire_post")
     */
    public function lire(Post $post){
        return $this->render('home/post.html.twig', [
            'post' => $post
        ]);
    }
}
