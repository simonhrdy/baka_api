<?php

namespace App\Controller;

use App\Entity\Stadium;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/stadiums', name: 'stadium_')]
class StadiumController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'List all stadiums',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'name', type: 'string', example: 'dasfas'),
                    new OA\Property(property: 'capacity', type: 'integer', example: 121),
                ]
            )
        )
    )]
    #[OA\Tag(name: 'Stadium')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $stadiums = $entityManager->getRepository(Stadium::class)->findAll();
        return $this->json($stadiums, 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Get a stadium by ID',
        content: new Model(type: Stadium::class)
    )]
    #[OA\Tag(name: 'Stadium')]
    public function getStadium(Stadium $stadium): JsonResponse
    {
        return $this->json($stadium, 200);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Stadium')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $stadium = new Stadium();
        $stadium->setName($data['name']);
        $stadium->setCapacity($data['capacity'] ?? null);

        $entityManager->persist($stadium);
        $entityManager->flush();

        return $this->json($stadium, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Stadium')]
    public function update(Stadium $stadium, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $stadium->setName($data['name'] ?? $stadium->getName());
        $stadium->setCapacity($data['capacity'] ?? $stadium->getCapacity());

        $entityManager->flush();

        return $this->json($stadium);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Stadium')]
    public function delete(Stadium $stadium, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($stadium);
        $entityManager->flush();

        return $this->json(null, 204);
    }

    #[Route('/available', methods: ['GET'])]
    #[OA\Tag(name: 'Stadium')]
    public function available(EntityManagerInterface $entityManager): JsonResponse
    {
        $qb = $entityManager->createQueryBuilder();
        $qb->select('s')
            ->from(Stadium::class, 's')
            ->leftJoin('App\Entity\Team', 't', 'WITH', 't.stadium_id = s')
            ->where('t.id IS NULL');

        $availableStadiums = $qb->getQuery()->getResult();

        return $this->json($availableStadiums, 200);
    }
}
