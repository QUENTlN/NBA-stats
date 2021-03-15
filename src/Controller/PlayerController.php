<?php

namespace App\Controller;

use App\Entity\Comparison;
use App\Repository\ComparisonRepository;
use App\Repository\PlayerRepository;
use App\Service\PlayerGenerator;
use App\Service\SeasonAverageGenerator;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/players/{search}", name="players", defaults={"search" = ""})
     * @param string $search
     * @param ComparisonRepository $comparisonRepository
     * @param HttpClientInterface $httpClient
     * @param PlayerGenerator $playerGenerator
     * @return Response
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function players(string $search, ComparisonRepository $comparisonRepository, HttpClientInterface $httpClient, PlayerGenerator $playerGenerator): Response
    {
        $lastComparisons = $comparisonRepository->findBy(array(),array('id'=>'DESC'),10,0);

        $response = $httpClient->request(
            'GET',
            'https://www.balldontlie.io/api/v1/players?search='.$search
        );
        $playerSearchAPI = $response->toArray()['data'];

        $playerSearch = [];
        foreach ($playerSearchAPI as $playerAPI){
            $playerSearch[] = $playerGenerator->getPlayer($playerAPI['id']);
        }

        return $this->render('player/players.html.twig', [
            'comparisons' => $lastComparisons,
            'playersSearch' => $playerSearch
        ]);
    }

    /**
     * @Route("/compare/{season}", name="compare", defaults={"season" = 0})
     * @param int|null $season
     * @param SeasonAverageGenerator $seasonAverageGenerator
     * @param Request $request
     * @return Response
     */
    public function compare(int $season, SeasonAverageGenerator $seasonAverageGenerator, Request $request): Response
    {
        $stats = null;
        if ($season !== 0) {
            if (isset($_GET['players'])) {
                $stats = [];
                foreach ($_GET['players'] as $idPlayer){
                    $stats[] = $seasonAverageGenerator->getStat($season, $idPlayer);
                }
            } else {
                $stats = null;
            }
        }
        return $this->render('player/compare.html.twig', [
            'stats' => $stats,
            'season' => $season
        ]);
    }


    /**
     * @Route("/updatebdd", name="updatebdd")
     * @param EntityManagerInterface $manager
     * @param ComparisonRepository $comparisonRepository
     * @param PlayerRepository $playerRepository
     * @param PlayerGenerator $playerGenerator
     * @return Response
     */
    public function updatebdd(EntityManagerInterface $manager, ComparisonRepository $comparisonRepository, PlayerRepository $playerRepository, PlayerGenerator $playerGenerator): Response
    {
        if ($_POST['idComparison'] === "") {
            $comparison = new Comparison();
            $comparison->setSeason($_POST['season']);
            foreach ($_POST['players'] as $playerPost) {
                $player = $playerRepository->findOneBy(['id' => $playerPost]);
                if ($player !== null) {
                    $comparison->addPlayer($player);
                } else {
                    $player = $playerGenerator->getPlayer($playerPost);
                    $manager->persist($player);
                    $comparison->addPlayer($player);
                }
            }
        } else {
            $comparison = $comparisonRepository->findOneBy(['id' => $_POST['idComparison']]);
            foreach ($comparison->getPlayers() as $player) {
                $comparison->removePlayer($player);
            }
            foreach ($_POST['players'] as $playerPost) {
                $player = $playerRepository->findOneBy(['id' => $playerPost]);
                if ($player !== null) {
                    $comparison->addPlayer($player);
                } else {
                    $player = $playerGenerator->getPlayer($playerPost);
                    $manager->persist($player);
                    $comparison->addPlayer($player);
                }
            }
        }
        $manager->persist($comparison);
        $manager->flush();

        return new Response ($comparison->getId());

    }
}
