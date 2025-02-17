<?php
namespace App\Controller;

use App\DTO\LoginResponse;
use App\Entity\User;
use App\Enum\Role;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class AuthController extends AbstractController
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
    ) {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->jwtManager = $jwtManager;
        $this->serializer = $serializer;
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['email'], $data['password'])) {
            return new JsonResponse(['message' => 'Invalid email or password'], 401);
        }

        $email = $data['email'];
        $password = $data['password'];

        $user = $this->userRepository->findOneBy(["email" => $email]);

        if (!$user || !$this->passwordHasher->isPasswordValid($user, $password)) {
            return new JsonResponse(['message' => 'Invalid email or password'], 401);
        }

        $userAgent = $request->headers->get('User-Agent');
        if (str_contains($userAgent, 'AdminApp')) {
            if (!in_array($user->getRole(), [Role::SUPERADMIN, Role::EDITOR, Role::MANAGER], true)) {
                return new JsonResponse(['message' => 'Access denied'], 403);
            }
        }

        $token = $this->jwtManager->create($user);

        $response = new LoginResponse();
        $response->setToken($token);
        $response->setEmail($user->getEmail());
        $response->setUsername($user->getName());
        $response->setRole($user->getRole()->getLabel());
        $response->setId($user->getId());

        return $this->json([
            "message" => "Valid",
            "data" => $response,
        ], 201);
    }
}
