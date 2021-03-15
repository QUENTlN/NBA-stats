<?php


namespace App\Service;


use App\Entity\Player;
use App\Entity\Team;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlayerGenerator
{
    private $httpClient;

    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
    }

    public function getPlayer($id_player): Player
    {
        $response = $this->httpClient->request(
            'GET',
            'https://www.balldontlie.io/api/v1/players/' . $id_player
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

        return $player;
    }
}