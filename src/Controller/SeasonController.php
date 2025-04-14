<?php

namespace App\Controller;

use App\Entity\League;
use App\Entity\Season;
use App\Entity\SeasonHasTeams;
use App\Repository\SeasonHasTeamsRepository;
use App\Repository\SeasonRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/seasons', name: 'season_')]
class SeasonController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Tag(name: 'Season')]
    #[OA\Response(
        response: 200,
        description: 'Get all seasons',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'is_active', type: 'boolean', example: true),
                    new OA\Property(property: 'yearEnd', type: 'string', format: 'date-time', example: '2025-02-21T15:26:40+00:00'),
                    new OA\Property(property: 'yearStart', type: 'string', format: 'date-time', example: '2025-01-21T15:26:47+00:00'),
                    new OA\Property(property: 'league_id', type: 'array', items: new OA\Items(type: 'object')),
                    new OA\Property(property: 'seasonHasTeams', type: 'array', items: new OA\Items(type: 'object')),
                ]
            )
        )
    )]
    public function list(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $seasons = $entityManager->getRepository(Season::class)->findAll();
        $json = $serializer->serialize($seasons, 'json', ['groups' => 'season:list']);

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get a season by ID',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'is_active', type: 'boolean', example: true),
                new OA\Property(property: 'yearEnd', type: 'string', format: 'date-time', example: '2025-02-21T15:26:40+00:00'),
                new OA\Property(property: 'yearStart', type: 'string', format: 'date-time', example: '2025-01-21T15:26:47+00:00'),
                new OA\Property(property: 'league_id', type: 'array', items: new OA\Items(type: 'object')),
                new OA\Property(property: 'seasonHasTeams', type: 'array', items: new OA\Items(type: 'object')),
            ],
            type: 'object'
        )
    )]
    #[OA\Tag(name: 'Season')]
    public function getSeason(Season $season, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($season, 'json', ['groups' => 'season:list']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Season')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $season = new Season();
        $season->setActive($data['is_active']);
        $season->setYearStart(new \DateTime($data['year_start']));
        $season->setYearEnd(new \DateTime($data['year_end']));

        $league = $entityManager->getRepository(League::class)->find($data['league_id']);
        if($league){
            $season->setLeagueId($league);
        }

        $entityManager->persist($season);
        $entityManager->flush();

        return $this->json([], 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Season')]
    public function update(Season $season, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $season->setActive($data['is_active'] ?? $season->isActive());
        if (isset($data['year_start'])) {
            $season->setYearStart(new \DateTime($data['year_start']));
        }
        if (isset($data['year_end'])) {
            $season->setYearEnd(new \DateTime($data['year_end']));
        }

        $entityManager->flush();

        return $this->json($season);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Season')]
    public function delete(Season $season, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($season);
        $entityManager->flush();
        return $this->json(null, 204);
    }

    #[Route('/{id}/deleteTeam/{idTeam}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Season')]
    public function deleteTeam(
        int $id,
        int $idTeam,
        EntityManagerInterface $entityManager,
        SeasonHasTeamsRepository $seasonHasTeamsRepository
    ): JsonResponse {
        $seasonHasTeam = $seasonHasTeamsRepository->findOneBy([
            'season_id' => $id,
            'team_id' => $idTeam,
        ]);

        if (!$seasonHasTeam) {
            return $this->json(['message' => 'Team not found in this season'], 404);
        }

        $entityManager->remove($seasonHasTeam);
        $entityManager->flush();

        return $this->json(null, 204);
    }

    #[Route('/{id}/addTeams', methods: ['POST'])]
    #[OA\Tag(name: 'Season')]
    public function addTeams(
        int $id,
        Request $request,
        EntityManagerInterface $entityManager,
        SeasonRepository $seasonRepository,
        TeamRepository $teamRepository
    ): JsonResponse {
        $season = $seasonRepository->find($id);
        if (!$season) {
            return $this->json(['message' => 'Season not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        if (!isset($data['teamIds']) || !is_array($data['teamIds'])) {
            return $this->json(['message' => 'Invalid teamIds data'], 400);
        }

        foreach ($data['teamIds'] as $teamId) {
            $team = $teamRepository->find($teamId);
            if (!$team) {
                continue;
            }

            $seasonHasTeam = new SeasonHasTeams();
            $seasonHasTeam->setSeasonId($season);
            $seasonHasTeam->setTeamId($team);
            $seasonHasTeam->setPoints(0);

            $entityManager->persist($seasonHasTeam);
        }

        $entityManager->flush();

        return $this->json(['message' => 'Teams added to season'], 201);
    }

}