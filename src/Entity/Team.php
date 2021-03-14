<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $abbreviation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $conference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $division;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $full_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="team")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="home_team", orphanRemoval=true)
     */
    private $hosted_games;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="visitor_team", orphanRemoval=true)
     */
    private $visited_games;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->hosted_games = new ArrayCollection();
        $this->visited_games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getConference(): ?string
    {
        return $this->conference;
    }

    public function setConference(string $conference): self
    {
        $this->conference = $conference;

        return $this;
    }

    public function getDivision(): ?string
    {
        return $this->division;
    }

    public function setDivision(string $division): self
    {
        $this->division = $division;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getHostedGames(): Collection
    {
        return $this->hosted_games;
    }

    public function addHostedGame(Game $hostedGame): self
    {
        if (!$this->hosted_games->contains($hostedGame)) {
            $this->hosted_games[] = $hostedGame;
            $hostedGame->setHomeTeam($this);
        }

        return $this;
    }

    public function removeHostedGame(Game $hostedGame): self
    {
        if ($this->hosted_games->removeElement($hostedGame)) {
            // set the owning side to null (unless already changed)
            if ($hostedGame->getHomeTeam() === $this) {
                $hostedGame->setHomeTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getVisitedGames(): Collection
    {
        return $this->visited_games;
    }

    public function addVisitedGame(Game $visitedGame): self
    {
        if (!$this->visited_games->contains($visitedGame)) {
            $this->visited_games[] = $visitedGame;
            $visitedGame->setVisitorTeam($this);
        }

        return $this;
    }

    public function removeVisitedGame(Game $visitedGame): self
    {
        if ($this->visited_games->removeElement($visitedGame)) {
            // set the owning side to null (unless already changed)
            if ($visitedGame->getVisitorTeam() === $this) {
                $visitedGame->setVisitorTeam(null);
            }
        }

        return $this;
    }
}
