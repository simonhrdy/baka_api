<?php

namespace App\Controller;

use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/countries', name: 'country_')]
class CountryController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Seznam všech zemí',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'name', type: 'string', example: 'Španělsko'),
                new OA\Property(property: 'shortName', type: 'string', example: 'SPA'),
            ],
            type: 'object'
        )
        )
    )]
    #[OA\Tag(name: 'Country')]
    public function list(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $countries = $entityManager->getRepository(Country::class)->findAll();
        $json = $serializer->serialize($countries, 'json', ['groups' => 'country:list']);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Detail konkrétní země',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'name', type: 'string', example: 'Španělsko'),
                new OA\Property(property: 'short_name', type: 'string', example: 'SPA'),
                new OA\Property(property: 'league', type: 'League'),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Země nenalezena'
    )]
    #[OA\Tag(name: 'Country')]
    public function getCountry(Country $country): JsonResponse
    {
        return $this->json($country, 200);
    }

    #[Route('', methods: ['POST'])]
    #[OA\Tag(name: 'Country')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['name']) || empty($data['short_name'])) {
            return $this->json(['error' => 'Název a zkratka jsou povinné'], 400);
        }

        $country = new Country();
        $country->setName($data['name']);
        $country->setShortName($data['short_name']);

        $entityManager->persist($country);
        $entityManager->flush();

        return $this->json($country, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'Country')]
    public function update(Country $country, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $country->setName($data['name']);
        }

        if (isset($data['short_name'])) {
            $country->setShortName($data['short_name']);
        }

        $entityManager->flush();

        return $this->json($country);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'Country')]
    public function delete(Country $country, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($country);
        $entityManager->flush();

        return $this->json(null, 201);
    }
}
