<?php

namespace App\Controller;

use ApiPlatform\Metadata\ApiResource;
use App\DTO\LoginRequest;
use App\DTO\LoginResponse;
use App\Entity\User;
use App\Enum\Role;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Security;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class AuthControllerAdmin extends AbstractController
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $passwordHasher;
    private JWTTokenManagerInterface $jwtManager;
    private SerializerInterface $serializer;

    public function __construct(
        UserRepository              $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface    $jwtManager,
        SerializerInterface         $serializer
    )
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->jwtManager = $jwtManager;
        $this->serializer = $serializer;
    }

    #[Route('/api/admin/login', name: 'api_admin_login', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        return $this->json([
            "message" => "Valid",
        ]);
    }
}
