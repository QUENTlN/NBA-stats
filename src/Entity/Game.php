<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="smallint")
     */
    private $home_team_score;

    /**
     * @ORM\Column(type="smallint")
     */
    private $visitor_team_score;

    /**
     * @ORM\Column(type="smallint")
     */
    private $season;

    /**
     * @ORM\Column(type="smallint")
     */
    private $period;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $time;

    /**
     * @ORM\Column(type="boolean")
     */
    private $postseason;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="hosted_games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $home_team;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="visited_games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visitor_team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHomeTeamScore(): ?int
    {
        return $this->home_team_score;
    }

    public function setHomeTeamScore(int $home_team_score): self
    {
        $this->home_team_score = $home_team_score;

        return $this;
    }

    public function getVisitorTeamScore(): ?int
    {
        return $this->visitor_team_score;
    }

    public function setVisitorTeamScore(int $visitor_team_score): self
    {
        $this->visitor_team_score = $visitor_team_score;

        return $this;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function setSeason(int $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getPeriod(): ?int
    {
        return $this->period;
    }

    public function setPeriod(int $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getPostseason(): ?bool
    {
        return $this->postseason;
    }

    public function setPostseason(bool $postseason): self
    {
        $this->postseason = $postseason;

        return $this;
    }

    public function getHomeTeam(): ?Team
    {
        return $this->home_team;
    }

    public function setHomeTeam(?Team $home_team): self
    {
        $this->home_team = $home_team;

        return $this;
    }

    public function getVisitorTeam(): ?Team
    {
        return $this->visitor_team;
    }

    public function setVisitorTeam(?Team $visitor_team): self
    {
        $this->visitor_team = $visitor_team;

        return $this;
    }
}
