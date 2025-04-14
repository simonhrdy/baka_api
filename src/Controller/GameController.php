<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\GameAnalysis;
use App\Entity\GameBetting;
use App\Entity\League;
use App\Entity\Lineup;
use App\Entity\Season;
use App\Entity\Team;
use App\Entity\User;
use App\Enum\Status;
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
        $game->setLap($data['lap'] ?? null);
        $game->setStatus(Status::from($data['status'] ?? Status::NOT_STARTED->value));

        $league = $entityManager->getRepository(League::class)->find($data['league_id'] ?? null);
        if ($league) {
            $game->setLeagueId($league);
        }

        $user = $entityManager->getRepository(User::class)->find($data['supervisor_id'] ?? null);
        $game->setSuperviserId($user ?? null);

        $homeTeam = $entityManager->getRepository(Team::class)->find($data['home_team_id']);
        $game->setHomeTeamId($homeTeam);

        $awayTeam = $entityManager->getRepository(Team::class)->find($data['away_team_id']);
        $game->setAwayTeamId($awayTeam);


        $entityManager->persist($game);
        $entityManager->flush();

        return $this->json([], 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Game')]
    public function update(Game $game, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['date_of_game'])) {
            $game->setDateOfGame(new \DateTime($data['date_of_game']));
        }

        $game->setLap($data['lap'] ?? null);
        $game->setStatus(Status::from($data['status'] ?? Status::NOT_STARTED->value));

        if (isset($data['league_id'])) {
            $league = $entityManager->getRepository(League::class)->find($data['league_id']);
            if ($league) {
                $game->setLeagueId($league);
            }
        }

        $user = $entityManager->getRepository(User::class)->find($data['supervisor_id'] ?? null);
        $game->setSuperviserId($user ?? null);

        if (isset($data['home_team_id'])) {
            $homeTeam = $entityManager->getRepository(Team::class)->find($data['home_team_id']);
            $game->setHomeTeamId($homeTeam);
        }

        if (isset($data['away_team_id'])) {
            $awayTeam = $entityManager->getRepository(Team::class)->find($data['away_team_id']);
            $game->setAwayTeamId($awayTeam);
        }

        $game->setParametrs($data['statistics'] ?? []);

        $entityManager->flush();

        return $this->json([], 200);
    }


    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Game')]
    public function delete(Game $game, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($game);
        $entityManager->flush();
        return $this->json(null, 204);
    }

    #[Route('/date/{date}/{sport}', methods: ['GET'])]
    #[OA\Tag(name: 'Game')]
    public function getByDate(string $date, string $sport, GameRepository $gameRepository, SerializerInterface $serializer): JsonResponse
    {
        $dateObject = \DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateObject) {
            return $this->json(['error' => 'Invalid date format'], 400);
        }
        $games = $gameRepository->findByDateAndSport($dateObject, $sport);
        $json = $serializer->serialize($games, 'json', ['groups' => 'game:list']);

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}/schedule', name: 'team_games', methods: ['GET'])]
    #[OA\Tag(name: 'Game')]
    public function getLastFiveGames(int $id, GameRepository $gameRepository): JsonResponse
    {
        $games = $gameRepository->findLastFiveGamesByTeamAndStatus($id);

        return $this->json($games, 200, [], ['groups' => 'game:list']);
    }

    #[Route('/{id}/results', name: 'team_games_results', methods: ['GET'])]
    #[OA\Tag(name: 'Game')]
    public function getFiveResults(int $id, GameRepository $gameRepository): JsonResponse
    {
        $games = $gameRepository->findFiveResult($id);

        return $this->json($games, 200, [], ['groups' => 'game:list']);
    }

    #[Route('/{playerId}/last-5-completed-games', name: 'get_last_5_completed_games_by_player', methods: ['GET'])]
    public function getLastFiveCompletedGamesByPlayer(int $playerId, GameRepository $gameRepository, SerializerInterface $serializer): JsonResponse
    {
        $games = $gameRepository->findLastFiveCompletedGamesByPlayerId($playerId);

        $data = $serializer->serialize($games, 'json', ['groups' => 'game:list']);

        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}/getLineup', methods: ['GET'])]
    #[OA\Tag(name: 'Game')]
    public function getLineup(Game $game, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $lineup = $entityManager->getRepository(Lineup::class)->findBy(['game' => $game]);

        if (!$lineup) {
            return $this->json(['error' => 'No lineup found for this game'], 404);
        }

        $json = $serializer->serialize($lineup, 'json', ['groups' => 'lineup:list']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}/getBetting', methods: ['GET'])]
    #[OA\Tag(name: 'Game')]
    public function getBetting(Game $game, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $betting = $entityManager->getRepository(GameBetting::class)->findOneBy(['game' => $game]);

        if (!$betting) {
            return $this->json(['error' => 'No betting tips found for this game'], 404);
        }

        $json = $serializer->serialize($betting, 'json', ['groups' => 'betting:list']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}/getAnalysis', methods: ['GET'])]
    #[OA\Tag(name: 'Game')]
    public function getAnalysis(Game $game, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $analysis = $entityManager->getRepository(GameAnalysis::class)->findOneBy(['game' => $game]);

        if (!$analysis) {
            return $this->json(['error' => 'No analysis found for this game'], 404);
        }

        $json = $serializer->serialize($analysis, 'json', ['groups' => 'analysis:list']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/viser/{id}/{date}', methods: ['GET'])]
    #[OA\Tag(name: 'Game')]
    public function getGameBySuperVisor(
        int $id,
        string $date,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        GameRepository $gameRepository
    ): JsonResponse {
        $dateObject = \DateTime::createFromFormat('Y-m-d', $date);

        $games = $gameRepository->findBySuperviserAndDate($id, $dateObject);

        $json = $serializer->serialize($games, 'json', ['groups' => 'game:list']);

        return new JsonResponse($json, 200, [], true);
    }


}
