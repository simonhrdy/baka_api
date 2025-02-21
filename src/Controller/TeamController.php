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
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'name', type: 'string', example: 'Arsenal'),
                    new OA\Property(property: 'surname', type: 'string', example: null, nullable: true),
                    new OA\Property(property: 'coach', type: 'string', example: 'DSAD'),
                    new OA\Property(property: 'image_src', type: 'string', example: 'dsada'),
                    new OA\Property(property: 'short_name', type: 'string', example: 'ARS'),
                    new OA\Property(
                        property: 'stadium_id',
                        properties: [
                            new OA\Property(property: 'id', type: 'integer', example: 1),
                            new OA\Property(property: 'name', type: 'string', example: 'dasfas'),
                            new OA\Property(property: 'capacity', type: 'integer', example: 121),
                        ],
                        type: 'object'
                    ),
                    new OA\Property(property: 'players', type: 'array', items: new OA\Items(type: 'object')),
                    new OA\Property(property: 'playerHistories', type: 'array', items: new OA\Items(type: 'object')),
                    new OA\Property(property: 'gamesHome', type: 'array', items: new OA\Items(type: 'object')),
                    new OA\Property(property: 'gamesAway', type: 'array', items: new OA\Items(type: 'object')),
                ],
                type: 'object'
            )
        )
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
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'name', type: 'string', example: 'Arsenal'),
                new OA\Property(property: 'surname', type: 'string', example: null, nullable: true),
                new OA\Property(property: 'coach', type: 'string', example: 'DSAD'),
                new OA\Property(property: 'image_src', type: 'string', example: 'dsada'),
                new OA\Property(property: 'short_name', type: 'string', example: 'ARS'),
                new OA\Property(
                    property: 'stadium_id',
                    properties: [
                        new OA\Property(property: 'id', type: 'integer', example: 1),
                        new OA\Property(property: 'name', type: 'string', example: 'dasfas'),
                        new OA\Property(property: 'capacity', type: 'integer', example: 121),
                    ],
                    type: 'object'
                ),
                new OA\Property(property: 'players', type: 'array', items: new OA\Items(type: 'object')),
                new OA\Property(property: 'playerHistories', type: 'array', items: new OA\Items(type: 'object')),
                new OA\Property(property: 'gamesHome', type: 'array', items: new OA\Items(type: 'object')),
                new OA\Property(property: 'gamesAway', type: 'array', items: new OA\Items(type: 'object')),
            ],
            type: 'object'
        )
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
