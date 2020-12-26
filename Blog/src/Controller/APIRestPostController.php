<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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
    public function getMyPosts(PostRepository $ripo) : JsonResponse
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

    /**
     * @Route("/api/otherposts", name="api_posts_other")
     */
    public function getOtherPosts(HttpClientInterface $client) : Response
    {
        $response = $client->request(
            'GET',
            'https://kaloun-mouhali-blog.herokuapp.com/api/posts'
        );

        $content = $response->getContent();
        $content = $response->toArray();

        return $this->render('api_rest_post/rest.html.twig', [
            'posts' => $content
        ]);
    }
}
