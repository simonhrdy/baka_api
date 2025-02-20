<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/users', name: 'user_')]
class UserController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new Model(type: User::class)
    )]
    #[OA\Tag(name: 'User')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $users = $entityManager->getRepository(User::class)->findAll();
        return $this->json($users, 200);
    }

    #[Route('/me', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new Model(type: User::class)
    )]
    #[OA\Tag(name: 'User')]
    public function getMe(): JsonResponse
    {
        return $this->json($this->getUser(), 200);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'User')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'User')]
    public function update(User $user, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user->setName($data['name'] ?? $user->getName());
        $user->setEmail($data['email'] ?? $user->getEmail());

        if (!empty($data['password'])) {
            $user->setPassword($data['password']);
        }

        $entityManager->flush();

        return $this->json($user);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'User')]
    public function delete(User $user, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->json(null, 204);
    }

    #[Route('/{id}/change-password', methods: ['POST'])]
    #[OA\Tag(name: 'User')]
    public function changePassword(User $user, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['new_password'])) {
            return $this->json(['error' => 'New password is required'], 400);
        }

        $user->setPassword($data['new_password']);
        $entityManager->flush();

        return $this->json(['message' => 'Password changed successfully']);
    }

    #[Route('/forgot-password', methods: ['POST'])]
    #[OA\Tag(name: 'User')]
    public function forgotPassword(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['email'])) {
            return $this->json(['error' => 'Email is required'], 400);
        }

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if (!$user) {
            return $this->json(['error' => 'User not found'], 404);
        }

        //TODO EMAIL RESET LINK

        return $this->json(['message' => 'If the email exists, a reset link has been sent']);
    }
}
