<?php

namespace App\Controller;

use App\Entity\League;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/league', name: 'league_')]
class LeagueController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all leagues',
    )]
    #[OA\Tag(name: 'League')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $leagues = $entityManager->getRepository(League::class)->findAll();
        return $this->json($leagues, 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get league by ID',
    )]
    #[OA\Tag(name: 'League')]
    public function getLeague(League $league): JsonResponse
    {
        return $this->json($league, 200);
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
}
