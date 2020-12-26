<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; // Nous avons besoin d'accéder à la requête pour obtenir le numéro de page
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator

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
    public function index(PostRepository $ripo, Request $request, PaginatorInterface $paginator)
    {
        $posts = $ripo->findAll();

        $articles = $paginator->paginate(
            $posts, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );

        return $this->render('home/index.html.twig', [
            'posts' => $articles
        ]);
    }

    /**
     * @Route("/posts/{author}", name="lire_post")
     */
    public function lire(Post $post){
        return $this->render('home/post.html.twig', [
            'post' => $post
        ]);
    }
}
