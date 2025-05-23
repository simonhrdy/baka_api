<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\User;
use App\Entity\UserHasFavoriteTeam;
use App\Repository\TeamRepository;
use App\Repository\UserHasFavoriteTeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Serializer\SerializerInterface;


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
        $user->setPassword($data['password'] ?? null);
        $user->setRoles($data['roles'] ?? []);

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

        $user->setRoles($data['roles'] ?? []);

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
    public function forgotPassword(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['email'])) {
            return $this->json(['error' => 'Email is required'], 400);
        }

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if (!$user) {
            return $this->json(['error' => 'User not found'], 404);
        }

        $token = bin2hex(random_bytes(32));
        $user->setResetToken($token);
        $user->setResetTokenExpiresAt(new \DateTime('+2 hour'));

        $entityManager->flush();

        $email = (new Email())
            ->from('no-reply@coral-app-pmzum.ondigitalocean.app')
            ->to($user->getEmail())
            ->subject('Password Reset Request')
            ->html('<p>Click the link to reset your password: <a href="http://localhost:3000/reset-password/'.$token.'">Reset Password</a></p>');

        $mailer->send($email);
        return $this->json(['message' => 'If the email exists, a reset link has been sent']);
    }

    #[Route('/reset-password', methods: ['POST'])]
    #[OA\Tag(name: 'User')]
    public function resetPassword(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['token']) || !isset($data['new_password'])) {
            return $this->json(['error' => 'Token and new password are required'], 400);
        }

        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $data['token']]);
        if (!$user || $user->getResetTokenExpiresAt() < new \DateTime()) {
            return $this->json(['error' => 'Invalid or expired token'], 400);
        }

        $user->setPassword($data['new_password']);
        $user->setResetToken(null);
        $user->setResetTokenExpiresAt(null);

        $entityManager->flush();

        return $this->json([
            'message' => 'Password has been successfully reset',
            'email' => $user->getEmail()
        ]);
    }


    #[Route('/verify-token', methods: ['POST'])]
    #[OA\Tag(name: 'User')]
    public function verifyToken(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['token'])) {
            return $this->json(['error' => 'Token is required'], 400);
        }

        $token = $data['token'];
        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user || $user->getResetTokenExpiresAt() < new \DateTime()) {
            return $this->json(['error' => 'Invalid or expired token'], 400);
        }
        return $this->json(['message' => 'Valid token']);
    }

    #[Route('/favorite-teams', methods: ['GET'])]
    #[OA\Tag(name: 'User')]
    public function getUserFavoriteTeams(UserHasFavoriteTeamRepository $userHasFavoriteTeamRepository, SerializerInterface $serializer): JsonResponse
    {
        $user = $this->getUser();
        $id = $user->getId();
        $favoriteTeams = $userHasFavoriteTeamRepository->findBy(['id_user' => $id]);
        $json = $serializer->serialize($favoriteTeams, 'json', ['groups' => 'favorite:list']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/favorite-teams', methods: ['POST'])]
    #[OA\Tag(name: 'User')]
    public function toggleFavoriteTeam(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->getUser();
        $teamId = $data['team_id'];

        $team = $entityManager->getRepository(Team::class)->find($teamId);

        if (!$team) {
            return $this->json(['error' => 'Team not found'], 404);
        }

        $favoriteTeamRepo = $entityManager->getRepository(UserHasFavoriteTeam::class);
        $existingFavorite = $favoriteTeamRepo->findOneBy([
            'id_user' => $user,
            'team_id' => $team
        ]);

        if ($existingFavorite) {
            $entityManager->remove($existingFavorite);
            $entityManager->flush();
            return $this->json(['message' => 'Team removed from favorites'], 200);
        } else {
            $userHasFavoriteTeam = new UserHasFavoriteTeam();
            $userHasFavoriteTeam->setIdUser($user);
            $userHasFavoriteTeam->setTeamId($team);

            $entityManager->persist($userHasFavoriteTeam);
            $entityManager->flush();

            return $this->json(['message' => 'Team added to favorites'], 201);
        }
    }

    #[Route('/favorite-teams/{sport}', methods: ['GET'])]
    #[OA\Tag(name: 'User')]
    public function getUserFavoriteTeamsBySport(
        string $sport,
        UserHasFavoriteTeamRepository $userHasFavoriteTeamRepository,
        SerializerInterface $serializer
    ): JsonResponse {
        $user = $this->getUser();
        $favoriteTeams = $userHasFavoriteTeamRepository->findFavoritesBySport($user->getId(), $sport);

        $json = $serializer->serialize($favoriteTeams, 'json', ['groups' => 'favorite:list']);

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Tag(name: 'User')]
    public function getPlayer(User $user): JsonResponse
    {
        return $this->json($user, 200, [], ['groups' => 'list:list']);
    }

}
