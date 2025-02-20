<?php

namespace App\Controller;

use App\Entity\Referee;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/referees', name: 'referee_')]
class RefereeController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get all referees',
    )]
    #[OA\Tag(name: 'Referee')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $referees = $entityManager->getRepository(Referee::class)->findAll();
        return $this->json($referees, 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get a referee by ID',
    )]
    #[OA\Tag(name: 'Referee')]
    public function getReferee(Referee $referee): JsonResponse
    {
        return $this->json($referee, 200);
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
