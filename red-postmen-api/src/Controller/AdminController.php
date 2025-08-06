<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// TODO make a kind of admin service
final class AdminController extends AbstractController
{

    #[Route('/api/admin/new-user', name: 'api_admin_new-user', methods: ['POST'])]
    public function createNewUser(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        if ('json' !== $request->getContentTypeFormat()) {
            throw new BadRequestException('Unsupported content format');
        }

        $authUser = $serializer->denormalize($request->attributes->get('user_payload'), User::class);
        if (!in_array('ROLE_ADMIN', $authUser->getRoles())) {
            throw new BadRequestException('Bad role');
        }

        $jsonData = $request->getContent();
        $newUser = $serializer->deserialize($jsonData, User::class, 'json');
        $newUser->setPassword($passwordHasher->hashPassword(
            $newUser,
            $newUser->getPassword()
        ));
        $entityManager->persist($newUser);
        $entityManager->flush();

        $newUser->unsetPassword();
        return $this->json($newUser);
    }

}