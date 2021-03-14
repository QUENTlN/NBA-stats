<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlayerController extends AbstractController
{
    /**
     * @Route("/player/{idPlayer}", name="player", requirements={"idPlayer"="\d+"})
     * @param int $idPlayer
     * @param HttpClientInterface $client
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function index(int $idPlayer, HttpClientInterface $client): Response
    {
        $response = $client->request(
            'GET',
            'https://www.balldontlie.io/api/v1/players/' . $idPlayer
        );

        $playerAPI = $response->toArray();

        $player = new Player();
        $player->setId($playerAPI['id']);
        $player->setFirstName($playerAPI['first_name']);
        $player->setLastName($playerAPI['last_name']);
        $player->setPosition($playerAPI['position']);
        $player->setHeightFeet($playerAPI['height_feet']);
        $player->setHeightInches($playerAPI['height_inches']);
        $player->setWeightPounds($playerAPI['weight_pounds']);

        $teamAPI = $playerAPI['team'];

        $team = new Team();
        $team->setId($teamAPI['id']);
        $team->setAbbreviation($teamAPI['abbreviation']);
        $team->setCity($teamAPI['city']);
        $team->setConference($teamAPI['conference']);
        $team->setDivision($teamAPI['division']);
        $team->setFullName($teamAPI['full_name']);
        $team->setName($teamAPI['name']);

        $player->setTeam($team);

        return $this->render('player/index.html.twig', [
            'player' => $player,
        ]);
    }
}
