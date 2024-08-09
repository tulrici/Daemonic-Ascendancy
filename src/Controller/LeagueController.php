<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class LeagueController extends AbstractController
{
    #[Route('/league', name: 'app_league')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LeagueController.php',
        ]);
    }

    #[Route('/league/rank/{id}', name: 'app_league')]
    public function filterListLeague(): JsonResponse
    {
        //TODO return the first(s) of a league

        $league = new League();
        $players = $league->getPlayers();
        $players = $players->orderBy('score', 'DESC');

        return $this->json([
            'message' => 'r!',
            'path' => 'src/Controller/LeagueController.php',
        ]);
    }
}
