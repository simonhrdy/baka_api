<?php

namespace App\Controller;

use App\Entity\League;
use App\Entity\Season;
use App\Entity\SeasonHasTeams;
use App\Entity\Stadium;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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
    public function list(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $teams = $entityManager->getRepository(Team::class)->findAll();
        $json = $serializer->serialize($teams, 'json', ['groups' => 'team:list']);
        return new JsonResponse($json, 200, [], true);
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
    public function getTeam(Team $team, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($team, 'json', ['groups' => 'team:list']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Team')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $team = new Team();
        $team->setName($data['name'] ?? '');
        $team->setSurname($data['surname'] ?? null);
        $team->setShortName($data['short_name'] ?? null);
        $team->setCoach($data['coach'] ?? null);

        if (!empty($data['imageBase64'])) {
            $imageData = base64_decode($data['imageBase64']);
            $filename = uniqid('team_', true) . '.jpg';
            $path = $this->getParameter('upload_directory') . '/' . $filename;
            file_put_contents($path, $imageData);
            $team->setImageSrc('https://coral-app-pmzum.ondigitalocean.app/uploads/' . $filename);
        }

        if (!empty($data['stadium_id'])) {
            $stadium = $entityManager->getRepository(Stadium::class)->find($data['stadium_id']);
            $team->setStadiumId($stadium ?? null);
        }

        $entityManager->persist($team);
        $entityManager->flush();

        return $this->json($team, 201, [], ['groups' => ['team:list']]);
    }



    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Team')]
    public function update(Team $team, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $team->setName($data['name'] ?? $team->getName());
        $team->setSurname($data['surname'] ?? $team->getSurname());
        $team->setShortName($data['short_name'] ?? $team->getShortName());
        $team->setCoach($data['coach'] ?? $team->getCoach());

        if (!empty($data['imageBase64'])) {
            $imageData = base64_decode($data['imageBase64']);
            $filename = uniqid('team_', true) . '.jpg';
            $path = $this->getParameter('upload_directory') . '/' . $filename;
            file_put_contents($path, $imageData);
            $team->setImageSrc('https://coral-app-pmzum.ondigitalocean.app/uploads/' . $filename);
        }

        if (!empty($data['stadium_id'])) {
            $stadium = $entityManager->getRepository(Stadium::class)->find($data['stadium_id']);
            $team->setStadiumId($stadium);
        }

        $entityManager->flush();

        return $this->json($team, 200, [], ['groups' => ['team:list']]);
    }


    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Team')]
    public function delete(Team $team, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($team);
        $entityManager->flush();
        return $this->json(null, 204);
    }

    #[Route('/league/{id}', methods: ['GET'])]
    #[OA\Tag(name: 'Team')]
    public function getTeamsByLeague(
        int $id,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $league = $entityManager->getRepository(League::class)->find($id);

        if (!$league) {
            return new JsonResponse(['error' => 'Liga nebyla nalezena.'], 404);
        }

        $activeSeason = $entityManager->getRepository(Season::class)->findOneBy([
            'league_id' => $league,
            'is_active' => true,
        ]);

        if (!$activeSeason) {
            return new JsonResponse([]);
        }

        $seasonHasTeams = $entityManager->getRepository(SeasonHasTeams::class)
            ->findBy(['season_id' => $activeSeason]);

        if (count($seasonHasTeams) < 2) {
            return new JsonResponse([]);
        }

        $teams = array_map(function (SeasonHasTeams $item) {
            $team = $item->getTeamId();
            return [
                'id' => $team->getId(),
                'name' => $team->getName(),
            ];
        }, $seasonHasTeams);

        return new JsonResponse($teams, 200);
    }

    #[Route('/not-in-season/{seasonId}', methods: ['GET'])]
    #[OA\Tag(name: 'Team')]
    public function getTeamsNotInSeason(
        int $seasonId,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ): JsonResponse {
        $season = $entityManager->getRepository(Season::class)->find($seasonId);

        if (!$season) {
            return new JsonResponse(['error' => 'Sezóna nebyla nalezena.'], 404);
        }

        $assignedTeamIds = $entityManager->getRepository(SeasonHasTeams::class)
            ->createQueryBuilder('sht')
            ->select('IDENTITY(sht.team_id)')
            ->where('sht.season_id = :season')
            ->setParameter('season', $seasonId)
            ->getQuery()
            ->getScalarResult();

        $assignedTeamIds = array_map(fn($item) => $item[1], $assignedTeamIds); // převést na ploché pole

        $qb = $entityManager->getRepository(Team::class)->createQueryBuilder('t');
        if (!empty($assignedTeamIds)) {
            $qb->where($qb->expr()->notIn('t.id', ':assignedTeamIds'))
                ->setParameter('assignedTeamIds', $assignedTeamIds);
        }

        $teamsNotInSeason = $qb->getQuery()->getResult();

        $json = $serializer->serialize($teamsNotInSeason, 'json', ['groups' => 'team:list']);

        return new JsonResponse($json, 200, [], true);
    }


}
