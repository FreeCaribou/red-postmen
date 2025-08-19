<?php

namespace App\Controller;

use App\Repository\PostmanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

// TODO make a service for area
final class PostmanController extends AbstractController
{

    #[Route('/api/postmen', name: 'get_all_postmen', methods: ['GET'])]
    public function getAllPostmen(PostmanRepository $repository): JsonResponse
    {
        $postmen = $repository->findAll();
        return $this->json($postmen, 200, [], ['groups' => ['postman:read']]);
    }
}
