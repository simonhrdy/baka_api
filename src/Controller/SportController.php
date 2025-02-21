<?php

namespace App\Controller;

use App\Entity\Sport;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sports', name: 'sport_')]
class SportController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all sports',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'name', type: 'string', example: 'sdadsa'),
                    new OA\Property(property: 'referees', example: null, nullable: true),
                    new OA\Property(property: 'league', example: null, nullable: true),
                ]
            )
        )
    )]
    #[OA\Tag(name: 'Sport')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $sports = $entityManager->getRepository(Sport::class)->findAll();
        return $this->json($sports, 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get a sport by ID',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'name', type: 'string', example: 'sdadsa'),
                new OA\Property(property: 'referees', type: '', example: null, nullable: true),
                new OA\Property(property: 'league', type: '', example: null, nullable: true),
            ],
            type: 'object'
        )
    )]
    #[OA\Tag(name: 'Sport')]
    public function getSport(Sport $sport): JsonResponse
    {
        return $this->json($sport, 200);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Sport')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $sport = new Sport();
        $sport->setName($data['name']);

        $entityManager->persist($sport);
        $entityManager->flush();

        return $this->json($sport, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Sport')]
    public function update(Sport $sport, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $sport->setName($data['name'] ?? $sport->getName());

        $entityManager->flush();

        return $this->json($sport);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Sport')]
    public function delete(Sport $sport, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($sport);
        $entityManager->flush();
        return $this->json(null, 204);
    }
}
