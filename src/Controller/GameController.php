<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Season;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/game', name: 'game_')]
class GameController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all games',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'home_team_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                    new OA\Property(property: 'away_team_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                    new OA\Property(property: 'lap', type: 'integer', example: 1),
                    new OA\Property(property: 'supervisor_id', type: 'integer', example: null, nullable: true),
                    new OA\Property(property: 'parametrs', type: 'array', items: new OA\Items(type: 'object'), example: [["param1" => "value1", "param2" => "value2"]]),
                    new OA\Property(property: 'date_of_game', type: 'string', format: 'date-time', example: '2025-02-21T15:43:28+00:00'),
                    new OA\Property(property: 'league_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                ],
                type: 'object'
            )
        )
        )]
    #[OA\Tag(name: 'Game')]
    public function list(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $seasons = $entityManager->getRepository(Game::class)->findAll();
        $json = $serializer->serialize($seasons, 'json', ['groups' => 'game:list']);

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get game by ID',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'home_team_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                new OA\Property(property: 'away_team_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                new OA\Property(property: 'lap', type: 'integer', example: 1),
                new OA\Property(property: 'supervisor_id', type: 'integer', example: null, nullable: true),
                new OA\Property(property: 'parametrs', type: 'array', items: new OA\Items(type: 'object'), example: [["param1" => "value1", "param2" => "value2"]]),
                new OA\Property(property: 'date_of_game', type: 'string', format: 'date-time', example: '2025-02-21T15:43:28+00:00'),
                new OA\Property(property: 'league_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
            ],
            type: 'object'
        )
    )]
    #[OA\Tag(name: 'Game')]
    public function getGame(Game $game, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($game, 'json', ['groups' => 'game:list']);
        return new JsonResponse($json, 200, [], true);
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
