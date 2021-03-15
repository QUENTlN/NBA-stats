<?php


namespace App\Service;


use App\Entity\SeasonAverage;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SeasonAverageGenerator
{
    private $httpClient;
    private $playerGenerator;

    public function __construct(HttpClientInterface $client, PlayerGenerator $playerGenerator)
    {
        $this->httpClient = $client;
        $this->playerGenerator = $playerGenerator;
    }

    public function getStat($season, $id_player): SeasonAverage
    {

        $response = $this->httpClient->request(
            'GET',
            'https://www.balldontlie.io/api/v1/season_averages?season=' . $season . '&player_ids[]=' . $id_player
        );
        $statAPI = $response->toArray()['data'][0];

        $stat = new SeasonAverage();

        $stat->setGamePlayed($statAPI['games_played']);

        $player = $this->playerGenerator->getPlayer($statAPI['player_id']);

        $stat->setPlayer($player);
        $stat->setSeason($season);
        $stat->setMin($statAPI['min']);
        $stat->setFgm($statAPI['fgm']);
        $stat->setFga($statAPI['fga']);
        $stat->setFg3m($statAPI['fg3m']);
        $stat->setFg3a($statAPI['fg3a']);
        $stat->setFtm($statAPI['ftm']);
        $stat->setFta($statAPI['fta']);
        $stat->setOreb($statAPI['oreb']);
        $stat->setDreb($statAPI['dreb']);
        $stat->setReb($statAPI['reb']);
        $stat->setAst($statAPI['ast']);
        $stat->setStl($statAPI['stl']);
        $stat->setBlk($statAPI['blk']);
        $stat->setTurnover($statAPI['turnover']);
        $stat->setPf($statAPI['pf']);
        $stat->setPts($statAPI['pts']);
        $stat->setFgPct($statAPI['fg_pct']);
        $stat->setFg3Pct($statAPI['fg3_pct']);
        $stat->setFtPct($statAPI['ft_pct']);

        return $stat;
    }
}