<?php

namespace App\Controller;

use App\Entity\Referee;
use App\Entity\Season;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/referees', name: 'referee_')]
class RefereeController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all referees',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'first_name', type: 'string', example: 'asdassad'),
                    new OA\Property(property: 'last_name', type: 'string', example: 'dsafasfsa'),
                    new OA\Property(property: 'sport_id', type: 'array', items: new OA\Items(type: 'object')),
                    new OA\Property(property: 'referees', type: 'array', items: new OA\Items(type: 'object')),
                ]
            )
        )
    )]
    #[OA\Tag(name: 'Referee')]
    public function list(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $seasons = $entityManager->getRepository(Referee::class)->findAll();
        $json = $serializer->serialize($seasons, 'json', ['groups' => 'match_read']);

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get a referee by ID',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'first_name', type: 'string', example: 'asdassad'),
                new OA\Property(property: 'last_name', type: 'string', example: 'dsafasfsa'),
                new OA\Property(property: 'sport_id', type: 'array', items: new OA\Items(type: 'object')),
                new OA\Property(property: 'referees', type: 'array', items: new OA\Items(type: 'object')),
            ],
            type: 'object'
        )
    )]
    #[OA\Tag(name: 'Referee')]
    public function getReferee(Referee $referee, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($referee, 'json', ['groups' => 'match_read']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Referee')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $referee = new Referee();
        $referee->setFirstName($data['first_name']);
        $referee->setLastName($data['last_name'] ?? null);

        $entityManager->persist($referee);
        $entityManager->flush();

        return $this->json($referee, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Referee')]
    public function update(Referee $referee, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $referee->setFirstName($data['first_name'] ?? $referee->getFirstName());
        $referee->setLastName($data['last_name'] ?? $referee->getLastName());

        $entityManager->flush();

        return $this->json($referee);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Referee')]
    public function delete(Referee $referee, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($referee);
        $entityManager->flush();
        return $this->json(null, 204);
    }
}
