<?php

namespace App\Controller;

use App\Entity\PlayerStats;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/player-stats', name: 'player_stats_')]
class PlayerStatsController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all player stats',
    )]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $playerStats = $entityManager->getRepository(PlayerStats::class)->findAll();
        return $this->json($playerStats, 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get player stats by ID',
    )]
    #[OA\Tag(name: 'PlayerStats')]
    public function getPlayerStats(PlayerStats $playerStats, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($playerStats, 'json', ['groups' => 'stats:list']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'PlayerStats')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $playerStats = new PlayerStats();
        $playerStats->setParametrs($data['parametrs'] ?? []);

        $entityManager->persist($playerStats);
        $entityManager->flush();

        return $this->json($playerStats, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'PlayerStats')]
    public function update(PlayerStats $playerStats, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $playerStats->setParametrs($data['parametrs'] ?? $playerStats->getParametrs());

        $entityManager->flush();

        return $this->json($playerStats);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'PlayerStats')]
    public function delete(PlayerStats $playerStats, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($playerStats);
        $entityManager->flush();
        return $this->json(null, 204);
    }
}
