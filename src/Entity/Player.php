<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $position;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $height_feet;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $height_inches;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $weight_pounds;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="players", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\OneToMany(targetEntity=SeasonAverage::class, mappedBy="player", orphanRemoval=true)
     */
    private $seasonAverages;

    /**
     * @ORM\ManyToMany(targetEntity=Comparison::class, mappedBy="players")
     */
    private $comparisons;

    public function __construct()
    {
        $this->seasonAverages = new ArrayCollection();
        $this->comparisons = new ArrayCollection();
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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getHeightFeet(): ?int
    {
        return $this->height_feet;
    }

    public function setHeightFeet(?int $height_feet): self
    {
        $this->height_feet = $height_feet;

        return $this;
    }

    public function getHeightInches(): ?int
    {
        return $this->height_inches;
    }

    public function setHeightInches(?int $height_inches): self
    {
        $this->height_inches = $height_inches;

        return $this;
    }

    public function getWeightPounds(): ?int
    {
        return $this->weight_pounds;
    }

    public function setWeightPounds(?int $weight_pounds): self
    {
        $this->weight_pounds = $weight_pounds;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    /**
     * @return Collection|SeasonAverage[]
     */
    public function getSeasonAverages(): Collection
    {
        return $this->seasonAverages;
    }

    public function addSeasonAverage(SeasonAverage $seasonAverage): self
    {
        if (!$this->seasonAverages->contains($seasonAverage)) {
            $this->seasonAverages[] = $seasonAverage;
            $seasonAverage->setPlayer($this);
        }

        return $this;
    }

    public function removeSeasonAverage(SeasonAverage $seasonAverage): self
    {
        if ($this->seasonAverages->removeElement($seasonAverage)) {
            // set the owning side to null (unless already changed)
            if ($seasonAverage->getPlayer() === $this) {
                $seasonAverage->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comparison[]
     */
    public function getComparisons(): Collection
    {
        return $this->comparisons;
    }

    public function addComparison(Comparison $comparison): self
    {
        if (!$this->comparisons->contains($comparison)) {
            $this->comparisons[] = $comparison;
            $comparison->addPlayer($this);
        }

        return $this;
    }

    public function removeComparison(Comparison $comparison): self
    {
        if ($this->comparisons->removeElement($comparison)) {
            $comparison->removePlayer($this);
        }

        return $this;
    }
}
