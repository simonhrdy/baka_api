<?php

namespace App\Controller;

use App\Entity\PlayerHistory;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/player-history', name: 'player_history_')]
class PlayerHistoryController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all player history records',
    )]
    #[OA\Tag(name: 'PlayerHistory')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $playerHistory = $entityManager->getRepository(PlayerHistory::class)->findAll();
        return $this->json($playerHistory, 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get player history by ID',
    )]
    #[OA\Tag(name: 'PlayerHistory')]
    public function getPlayerHistory(PlayerHistory $playerHistory): JsonResponse
    {
        return $this->json($playerHistory, 200);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'PlayerHistory')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $playerHistory = new PlayerHistory();
        $playerHistory->setDateOfTransfer(new \DateTime($data['date_of_transfer']));

        $entityManager->persist($playerHistory);
        $entityManager->flush();

        return $this->json($playerHistory, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'PlayerHistory')]
    public function update(PlayerHistory $playerHistory, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $playerHistory->setDateOfTransfer(new \DateTime($data['date_of_transfer'] ?? $playerHistory->getDateOfTransfer()->format('Y-m-d')));

        $entityManager->flush();

        return $this->json($playerHistory);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'PlayerHistory')]
    public function delete(PlayerHistory $playerHistory, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($playerHistory);
        $entityManager->flush();
        return $this->json(null, 204);
    }
}
