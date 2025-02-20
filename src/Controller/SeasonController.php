<?php

namespace App\Controller;

use App\Entity\Season;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/seasons', name: 'season_')]
class SeasonController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all seasons',
    )]
    #[OA\Tag(name: 'Season')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $seasons = $entityManager->getRepository(Season::class)->findAll();
        return $this->json($seasons, 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get a season by ID',
    )]
    #[OA\Tag(name: 'Season')]
    public function getSeason(Season $season): JsonResponse
    {
        return $this->json($season, 200);
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

        $entityManager->persist($season);
        $entityManager->flush();

        return $this->json($season, 201);
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
}