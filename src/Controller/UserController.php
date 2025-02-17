<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractController
{
    #[Route('/api/user/me', name: 'api_user_me', methods: ['GET'])]
    public function getUserData(JWTTokenManagerInterface $JWTTokenManager, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $request->headers->get('Authorization');
        $token = substr($user, 7);

        try {
            $payload = $JWTTokenManager->parse($token);
        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $payload['email']]);

        if (!$user) {
            return $this->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'username' => $user->getName(),
        ], 200);
    }

}
