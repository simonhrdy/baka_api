<?php

namespace App\Controller;

use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $players = $entityManager->getRepository(Player::class)->findAll();
        return $this->json($players, 200);
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
        return $this->json($player, 200, [], ['groups' => ['player:read']]);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Player')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $player = new Player();
        $player->setFirstName($data['first_name']);
        $player->setLastName($data['last_name']);
        $player->setBirthdate(new \DateTime($data['birthdate']));

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
}
