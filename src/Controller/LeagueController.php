<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\League;
use App\Repository\GameRepository;
use App\Repository\LeagueRepository;
use App\Repository\SeasonHasTeamsRepository;
use App\Repository\SeasonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/league', name: 'league_')]
class LeagueController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all leagues',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'association', type: 'string', example: 'dasfas'),
                    new OA\Property(property: 'name', type: 'string', example: 'dsafas'),
                    new OA\Property(property: 'country_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                    new OA\Property(property: 'sport_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                    new OA\Property(property: 'seasons', type: 'array', items: new OA\Items(type: 'array', items: new OA\Items(type: 'integer')), example: [[1]]), // Adjust this depending on the actual structure of seasons
                ],
                type: 'object'
            )
        )
    )]
    #[OA\Tag(name: 'League')]
    public function list(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $seasons = $entityManager->getRepository(League::class)->findAll();
        $json = $serializer->serialize($seasons, 'json', ['groups' => 'league:list']);

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get league by ID',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'association', type: 'string', example: 'dasfas'),
                new OA\Property(property: 'name', type: 'string', example: 'dsafas'),
                new OA\Property(property: 'country_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                new OA\Property(property: 'sport_id', type: 'array', items: new OA\Items(type: 'integer'), example: [1]),
                new OA\Property(property: 'seasons', type: 'array', items: new OA\Items(type: 'array', items: new OA\Items(type: 'integer')), example: [[1]]), // Adjust based on your seasons structure
            ],
            type: 'object'
        )
    )]
    #[OA\Tag(name: 'League')]
    public function getLeague(League $league, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($league, 'json', ['groups' => 'league:list']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'League')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $league = new League();
        $league->setName($data['name'] ?? '');
        $league->setAssocation($data['assocation'] ?? null);

        $entityManager->persist($league);
        $entityManager->flush();

        return $this->json($league, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'League')]
    public function update(League $league, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $league->setName($data['name'] ?? $league->getName());
        $league->setAssocation($data['assocation'] ?? $league->getAssocation());

        $entityManager->flush();

        return $this->json($league);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'League')]
    public function delete(League $league, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($league);
        $entityManager->flush();
        return $this->json(null, 204);
    }

    #[Route('/sport/{sport}', methods: ['GET'])]
    #[OA\Tag(name: 'League')]
    public function getByDate(string $sport, LeagueRepository $leagueRepository, SerializerInterface $serializer): JsonResponse
    {
        $league = $leagueRepository->findBySport($sport);
        $json = $serializer->serialize($league, 'json', ['groups' => 'league:list']);

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/table/{id}', name: 'get_league_info', methods: ['GET'])]
    #[OA\Tag(name: 'League')]
    public function getLeagueInfo(
        int $id,
        LeagueRepository $leagueRepository,
        SeasonRepository $seasonRepository,
        SeasonHasTeamsRepository $seasonHasTeamsRepository
    ): JsonResponse {
        $league = $leagueRepository->find($id);
        if (!$league) {
            return $this->json(['error' => 'League not found'], 404);
        }

        $season = $seasonRepository->findOneBy(['league_id' => $league, 'is_active' => true]);
        if (!$season) {
            return $this->json(['error' => 'No active season found for this league'], 404);
        }

        $seasonTeams = $seasonHasTeamsRepository->findBy(['season_id' => $season]);
        $teamsData = [];

        foreach ($seasonTeams as $seasonTeam) {
            $team = $seasonTeam->getTeamId();
            $teamsData[] = [
                'id' => $team->getId(),
                'name' => $team->getName(),
                'short_name' => $team->getShortName(),
                'points' => $seasonTeam->getPoints(),
            ];
        }

        return $this->json([
            'league' => [
                'id' => $league->getId(),
                'name' => $league->getName(),
                'association' => $league->getAssocation(),
                'sport' => $league->getSport()?->getName(),
                'image_src' => $league->getImageSrc() ?? '',
            ],
            'season' => [
                'id' => $season->getId(),
                'year_start' => $season->getYearStart()->format('Y-m-d'),
                'year_end' => $season->getYearEnd()->format('Y-m-d'),
            ],
            'teams' => $teamsData,
        ]);
    }
}
