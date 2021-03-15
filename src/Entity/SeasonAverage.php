<?php

namespace App\Entity;

use App\Repository\SeasonAverageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeasonAverageRepository::class)
 */
class SeasonAverage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $game_played;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="seasonAverages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\Column(type="smallint")
     */
    private $season;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $min;

    /**
     * @ORM\Column(type="float")
     */
    private $fgm;

    /**
     * @ORM\Column(type="float")
     */
    private $fga;

    /**
     * @ORM\Column(type="float")
     */
    private $fg3m;

    /**
     * @ORM\Column(type="float")
     */
    private $fg3a;

    /**
     * @ORM\Column(type="float")
     */
    private $ftm;

    /**
     * @ORM\Column(type="float")
     */
    private $fta;

    /**
     * @ORM\Column(type="float")
     */
    private $oreb;

    /**
     * @ORM\Column(type="float")
     */
    private $dreb;

    /**
     * @ORM\Column(type="float")
     */
    private $reb;

    /**
     * @ORM\Column(type="float")
     */
    private $ast;

    /**
     * @ORM\Column(type="float")
     */
    private $stl;

    /**
     * @ORM\Column(type="float")
     */
    private $blk;

    /**
     * @ORM\Column(type="float")
     */
    private $turnover;

    /**
     * @ORM\Column(type="float")
     */
    private $pf;

    /**
     * @ORM\Column(type="float")
     */
    private $pts;

    /**
     * @ORM\Column(type="float")
     */
    private $fg_pct;

    /**
     * @ORM\Column(type="float")
     */
    private $fg3_pct;

    /**
     * @ORM\Column(type="float")
     */
    private $ft_pct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGamePlayed(): ?int
    {
        return $this->game_played;
    }

    public function setGamePlayed(int $game_played): self
    {
        $this->game_played = $game_played;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

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

    public function getMin(): ?string
    {
        return $this->min;
    }

    public function setMin(string $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getFgm(): ?float
    {
        return $this->fgm;
    }

    public function setFgm(float $fgm): self
    {
        $this->fgm = $fgm;

        return $this;
    }

    public function getFga(): ?float
    {
        return $this->fga;
    }

    public function setFga(float $fga): self
    {
        $this->fga = $fga;

        return $this;
    }

    public function getFg3m(): ?float
    {
        return $this->fg3m;
    }

    public function setFg3m(float $fg3m): self
    {
        $this->fg3m = $fg3m;

        return $this;
    }

    public function getFg3a(): ?float
    {
        return $this->fg3a;
    }

    public function setFg3a(float $fg3a): self
    {
        $this->fg3a = $fg3a;

        return $this;
    }

    public function getFtm(): ?float
    {
        return $this->ftm;
    }

    public function setFtm(float $ftm): self
    {
        $this->ftm = $ftm;

        return $this;
    }

    public function getFta(): ?float
    {
        return $this->fta;
    }

    public function setFta(float $fta): self
    {
        $this->fta = $fta;

        return $this;
    }

    public function getOreb(): ?float
    {
        return $this->oreb;
    }

    public function setOreb(float $oreb): self
    {
        $this->oreb = $oreb;

        return $this;
    }

    public function getDreb(): ?float
    {
        return $this->dreb;
    }

    public function setDreb(float $dreb): self
    {
        $this->dreb = $dreb;

        return $this;
    }

    public function getReb(): ?float
    {
        return $this->reb;
    }

    public function setReb(float $reb): self
    {
        $this->reb = $reb;

        return $this;
    }

    public function getAst(): ?float
    {
        return $this->ast;
    }

    public function setAst(float $ast): self
    {
        $this->ast = $ast;

        return $this;
    }

    public function getStl(): ?float
    {
        return $this->stl;
    }

    public function setStl(float $stl): self
    {
        $this->stl = $stl;

        return $this;
    }

    public function getBlk(): ?float
    {
        return $this->blk;
    }

    public function setBlk(float $blk): self
    {
        $this->blk = $blk;

        return $this;
    }

    public function getTurnover(): ?float
    {
        return $this->turnover;
    }

    public function setTurnover(float $turnover): self
    {
        $this->turnover = $turnover;

        return $this;
    }

    public function getPf(): ?float
    {
        return $this->pf;
    }

    public function setPf(float $pf): self
    {
        $this->pf = $pf;

        return $this;
    }

    public function getPts(): ?float
    {
        return $this->pts;
    }

    public function setPts(float $pts): self
    {
        $this->pts = $pts;

        return $this;
    }

    public function getFgPct(): ?float
    {
        return $this->fg_pct;
    }

    public function setFgPct(float $fg_pct): self
    {
        $this->fg_pct = $fg_pct;

        return $this;
    }

    public function getFg3Pct(): ?float
    {
        return $this->fg3_pct;
    }

    public function setFg3Pct(float $fg3_pct): self
    {
        $this->fg3_pct = $fg3_pct;

        return $this;
    }

    public function getFtPct(): ?float
    {
        return $this->ft_pct;
    }

    public function setFtPct(float $ft_pct): self
    {
        $this->ft_pct = $ft_pct;

        return $this;
    }
}
