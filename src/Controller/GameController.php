<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game', name: 'game_')]
class GameController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all games',

    )]
    #[OA\Tag(name: 'Game')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $games = $entityManager->getRepository(Game::class)->findAll();
        return $this->json($games, 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get game by ID',
    )]
    #[OA\Tag(name: 'Game')]
    public function getGame(Game $game): JsonResponse
    {
        return $this->json($game, 200);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Game')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $game = new Game();
        $game->setDateOfGame(new \DateTime($data['date_of_game']));

        $entityManager->persist($game);
        $entityManager->flush();

        return $this->json($game, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Game')]
    public function update(Game $game, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (isset($data['date_of_game'])) {
            $game->setDateOfGame(new \DateTime($data['date_of_game']));
        }

        $entityManager->flush();

        return $this->json($game);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Game')]
    public function delete(Game $game, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($game);
        $entityManager->flush();
        return $this->json(null, 204);
    }

    #[Route('/date/{date}', methods: ['GET'])]
    #[OA\Tag(name: 'Game')]
    public function getByDate(string $date, GameRepository $gameRepository): JsonResponse
    {
        $dateObject = \DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateObject) {
            return $this->json(['error' => 'Invalid date format'], 400);
        }
        $games = $gameRepository->findByDate($dateObject);

        return $this->json($games);
    }
}
