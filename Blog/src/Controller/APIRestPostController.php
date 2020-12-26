<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIRestPostController extends AbstractController
{
    /**
     * @Route("/api/rest/post", name="a_p_i_rest_post")
     */
    public function index(): Response
    {
        return $this->render('api_rest_post/index.html.twig', [
            'controller_name' => 'APIRestPostController',
        ]);
    }

    /**
     * @Route("/api/posts", name="api_posts",  methods={"GET"})
     */
    public function getAllPosts(PostRepository $ripo) : JsonResponse
    {
        $posts = $ripo->findLastFivePosts();
        $data = [];

        foreach ($posts as $post) {
            $data[] = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'author' => $post->getAuthor(),
                'content' => $post->getContent(),
                'createdAt' => $post->getCreatedAt(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
