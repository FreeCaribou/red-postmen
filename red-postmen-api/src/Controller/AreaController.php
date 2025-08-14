<?php

namespace App\Controller;

use App\Repository\AreaRepository;
use App\Entity\Area;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\JwtService;

// TODO make a service for area
final class AreaController extends AbstractController
{

    #[Route('/api/areas', name: 'get_all_areas', methods: ['GET'])]
    public function getAllAreas(AreaRepository $repository, Request $request): JsonResponse
    {
        $areas = $repository->findAll();
        return $this->json($areas, 200, [], ['groups' => ['area:read']]);
    }

    #[Route('/api/areas/{id}', name: 'get_area_by_id', methods: ['GET'])]
    public function getAreaById(string $id, AreaRepository $repository): JsonResponse
    {
        $area = $repository->find($id);
        return $this->json($area);
    }

    #[Route('/api/areas', name: 'create_area', methods: ['POST'])]
    public function createOneArea(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        // TODO verify the format of the delimitation in the json
        if ('json' !== $request->getContentTypeFormat()) {
            throw new BadRequestException('Unsupported content format');
        }

        $jsonData = $request->getContent();
        $area = $serializer->deserialize($jsonData, Area::class, 'json');
        $entityManager->persist($area);
        $entityManager->flush();

        return $this->json($area);
    }

}
