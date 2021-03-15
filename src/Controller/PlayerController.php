<?php

namespace App\Controller;

use App\Service\PlayerGenerator;
use App\Service\SeasonAverageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlayerController extends AbstractController
{
    /**
     * @Route("/player/{idPlayer}", name="player", requirements={"idPlayer"="\d+"})
     * @param int $idPlayer
     * @param PlayerGenerator $playerGenerator
     * @return Response
     */
    public function index(int $idPlayer, PlayerGenerator $playerGenerator): Response
    {
        $player = $playerGenerator->getPlayer($idPlayer);

        return $this->render('player/index.html.twig', [
            'player' => $player,
        ]);
    }

    /**
     * @Route("/compare/{season}/{idPlayer}", name="compare", defaults={"season" = 0, "idPlayer" = 0})
     * @param int|null $season
     * @param int $idPlayer
     * @param SeasonAverageGenerator $seasonAverageGenerator
     * @return Response
     */
    public function compare(int $season, int $idPlayer, SeasonAverageGenerator $seasonAverageGenerator): Response
    {
        if ($season !== 0){
            if ($idPlayer !== 0){
                $stat = $seasonAverageGenerator->getStat($season,$idPlayer);
            }else{
                $stat = null;
            }
        }else{
            $season = null;
            $stat = null;
        }
        return $this->render('player/compare.html.twig', [
            'stat' => $stat,
            'season' => $season
        ]);
    }
}
