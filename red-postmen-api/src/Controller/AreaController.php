<?php

namespace App\Controller;

use App\Repository\AreaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AreaController extends AbstractController
{

    #[Route('/areas', name: 'get_all_area', methods: ['GET'])]
    public function getAllArea(AreaRepository $repository): JsonResponse
    {
        $areas = $repository->findAll();

        return $this->json($areas);
    }

}
