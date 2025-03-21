<?php

namespace App\Controller;

use App\Entity\League;
use App\Entity\Player;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;

class SearchController extends AbstractController
{
    #[Route('/search/{value}', methods: ['GET'])]
    #[OA\Tag(name: 'Search')]
    public function index(string $value, EntityManagerInterface $entityManager): JsonResponse {

        $leagueQuery = $entityManager->getRepository(League::class)
            ->createQueryBuilder('l')
            ->select('l.id', 'l.name', 'l.image_src')
            ->where('l.name LIKE :value')
            ->setParameter('value', '%' . $value . '%')
            ->setMaxResults(5)
            ->getQuery();

        $leagues = $leagueQuery->getResult();

        $teamQuery = $entityManager->getRepository(Team::class)
            ->createQueryBuilder('t')
            ->select('t.id', 't.name', 't.image_src')
            ->where('t.name LIKE :value')
            ->setParameter('value', '%' . $value . '%')
            ->setMaxResults(5)
            ->getQuery();

        $teams = $teamQuery->getResult();

        $playerQuery = $entityManager->getRepository(Player::class)
            ->createQueryBuilder('p')
            ->select('p.id', 'p.first_name', 'p.last_name', 'p.image_src')
            ->where('p.first_name LIKE :value OR p.last_name LIKE :value')
            ->setParameter('value', '%' . $value . '%')
            ->setMaxResults(5)
            ->getQuery();

        $players = $playerQuery->getResult();

        $result = [];

        foreach ($leagues as $league) {
            $result[] = [
                'id' => $league['id'],
                'name' => $league['name'],
                'image_src' => $league['image_src'],
                'type' => 'league',
            ];
        }

        foreach ($teams as $team) {
            $result[] = [
                'id' => $team['id'],
                'name' => $team['name'],
                'image_src' => $team['image_src'],
                'type' => 'team',
            ];
        }

        foreach ($players as $player) {
            $result[] = [
                'id' => $player['id'],
                'name' => $player['first_name'] . ' ' . $player['last_name'],
                'image_src' => $player['image_src'],
                'type' => 'player',
            ];
        }

        if (empty($result)) {
            return new JsonResponse(['message' => 'No matches found'], [], 404);
        }

        return new JsonResponse($result);
    }

}
