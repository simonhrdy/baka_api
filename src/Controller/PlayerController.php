<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Lineup;
use App\Entity\Player;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/players', name: 'player_')]
class PlayerController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Tag(name: 'Player')]
    #[OA\Response(
        response: 200,
        description: 'List of players',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'birthdate', type: 'DateTimeInterface', example: '1990-01-01'),
                    new OA\Property(property: 'firstName', type: 'string', example: 'Jan'),
                    new OA\Property(property: 'lastName', type: 'string', example: 'Jan'),
                    new OA\Property(property: 'team_id', type: 'integer', example: 1),
                    new OA\Property(property: 'country_id', type: 'integer', example: 1),
                    new OA\Property(property: 'playerHistory', type: 'Collection'),
                ],
                type: 'object'
            )
        )
    )]
    public function list(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $players = $entityManager->getRepository(Player::class)->findAll();
        $json = $serializer->serialize($players, 'json', ['groups' => 'player:list']);

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Tag(name: 'Player')]
    #[OA\Response(
        response: 200,
        description: "Player's details",
        content: new OA\JsonContent(
                properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'birthdate', type: 'DateTimeInterface', example: '1990-01-01'),
                new OA\Property(property: 'firstName', type: 'string', example: 'Jan'),
                new OA\Property(property: 'lastName', type: 'string', example: 'Jan'),
                new OA\Property(property: 'team_id', type: 'integer', example: 1),
                new OA\Property(property: 'country_id', type: 'integer', example: 1),
                new OA\Property(property: 'playerHistory', type: 'Collection'),
                ],
                type: 'object'
            )
        )]
    public function getPlayer(Player $player): JsonResponse
    {
        return $this->json($player, 200, [], ['groups' => 'player:list']);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Player')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = $request->request->all();
        $file = $request->files->get('image');

        $player = new Player();
        $player->setFirstName($data['name'] ?? '');
        $player->setLastName($data['surname'] ?? '');
        $player->setBirthdate($data['birthdate'] ?? null);


        $player->setPosition($data['position'] ?? null);
        $player->setNumber(isset($data['number']) ? (int)$data['number'] : null);

        if ($file) {
            $filename = uniqid('player_', true) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $filename);
            $player->setImageSrc('https://coral-app-pmzum.ondigitalocean.app/uploads/' . $filename);
        }

        $team = $entityManager->getRepository(Team::class)->find($data['team'] ?? null);
        $player->setTeamId($team ?? null);

        $country = $entityManager->getRepository(Country::class)->find($data['country'] ?? null);
        $player->setCountry($country ?? null);

        $entityManager->persist($player);
        $entityManager->flush();

        return $this->json($player, 201, [], ['groups' => ['player:read']]);
    }


    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Player')]
    public function update(Player $player, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $player->setFirstName($data['first_name'] ?? $player->getFirstName());
        $player->setLastName($data['last_name'] ?? $player->getLastName());
        if (!empty($data['birthdate'])) {
            $player->setBirthdate(new \DateTime($data['birthdate']));
        }

        $entityManager->flush();

        return $this->json($player, 200, [], ['groups' => ['player:read']]);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Player')]
    public function delete(Player $player, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($player);
        $entityManager->flush();
        return $this->json(null, 204);
    }


    #[Route('/{id}/matches', methods: ['GET'])]
    #[OA\Tag(name: 'Player')]
    public function getPlayerMatches(int $id, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $player = $entityManager->getRepository(Player::class)->find($id);
        if (!$player) {
            return $this->json(['error' => 'Player not found'], 404);
        }

        $matches = $entityManager->getRepository(Lineup::class)->findBy(
            ['player' => $player],
            ['id' => 'DESC'],
            5
        );
        $json = $serializer->serialize($matches, 'json', ['groups' => 'player_games:list']);
        return new JsonResponse($json, 200, [], true);
    }
}
