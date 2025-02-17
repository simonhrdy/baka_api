<?php

namespace App\Controller;
use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GameDateController extends AbstractController
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function __invoke(Request $request, String $date): JsonResponse
    {
        $dateObject = \DateTime::createFromFormat('Y-m-d', $date);
        $games = $this->gameRepository->findByDate($dateObject);

        return $this->json($games);
    }
}