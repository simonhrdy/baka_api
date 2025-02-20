<?php

namespace App\Controller;

use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/teams', name: 'team_')]
class TeamController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
    )]
    #[OA\Tag(name: 'Team')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $teams = $entityManager->getRepository(Team::class)->findAll();
        return $this->json($teams, 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
    )]
    #[OA\Tag(name: 'Team')]
    public function getTeam(Team $team): JsonResponse
    {
        return $this->json($team, 200);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Team')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $team = new Team();
        $team->setName($data['name']);
        $team->setShortName($data['short_name'] ?? null);
        $team->setCoach($data['coach'] ?? null);
        $team->setImageSrc($data['image_src'] ?? null);

        $entityManager->persist($team);
        $entityManager->flush();

        return $this->json($team, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Team')]
    public function update(Team $team, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $team->setName($data['name'] ?? $team->getName());
        $team->setShortName($data['short_name'] ?? $team->getShortName());
        $team->setCoach($data['coach'] ?? $team->getCoach());
        $team->setImageSrc($data['image_src'] ?? $team->getImageSrc());

        $entityManager->flush();

        return $this->json($team);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Team')]
    public function delete(Team $team, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($team);
        $entityManager->flush();
        return $this->json(null, 204);
    }
}
