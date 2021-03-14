<?php

namespace App\Entity;

use App\Repository\StatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatRepository::class)
 */
class Stat
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
    private $ast;

    /**
     * @ORM\Column(type="smallint")
     */
    private $blk;

    /**
     * @ORM\Column(type="smallint")
     */
    private $dreb;

    /**
     * @ORM\Column(type="smallint")
     */
    private $fg3_pct;

    /**
     * @ORM\Column(type="smallint")
     */
    private $fg3a;

    /**
     * @ORM\Column(type="smallint")
     */
    private $fg3m;

    /**
     * @ORM\Column(type="float")
     */
    private $fg_pct;

    /**
     * @ORM\Column(type="smallint")
     */
    private $fga;

    /**
     * @ORM\Column(type="smallint")
     */
    private $fgm;

    /**
     * @ORM\Column(type="float")
     */
    private $ft_pct;

    /**
     * @ORM\Column(type="smallint")
     */
    private $fta;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ftm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getAst(): ?int
    {
        return $this->ast;
    }

    public function setAst(int $ast): self
    {
        $this->ast = $ast;

        return $this;
    }

    public function getBlk(): ?int
    {
        return $this->blk;
    }

    public function setBlk(int $blk): self
    {
        $this->blk = $blk;

        return $this;
    }

    public function getDreb(): ?int
    {
        return $this->dreb;
    }

    public function setDreb(int $dreb): self
    {
        $this->dreb = $dreb;

        return $this;
    }

    public function getFg3Pct(): ?int
    {
        return $this->fg3_pct;
    }

    public function setFg3Pct(int $fg3_pct): self
    {
        $this->fg3_pct = $fg3_pct;

        return $this;
    }

    public function getFg3a(): ?int
    {
        return $this->fg3a;
    }

    public function setFg3a(int $fg3a): self
    {
        $this->fg3a = $fg3a;

        return $this;
    }

    public function getFg3m(): ?int
    {
        return $this->fg3m;
    }

    public function setFg3m(int $fg3m): self
    {
        $this->fg3m = $fg3m;

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

    public function getFga(): ?int
    {
        return $this->fga;
    }

    public function setFga(int $fga): self
    {
        $this->fga = $fga;

        return $this;
    }

    public function getFgm(): ?int
    {
        return $this->fgm;
    }

    public function setFgm(int $fgm): self
    {
        $this->fgm = $fgm;

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

    public function getFta(): ?int
    {
        return $this->fta;
    }

    public function setFta(int $fta): self
    {
        $this->fta = $fta;

        return $this;
    }

    public function getFtm(): ?int
    {
        return $this->ftm;
    }

    public function setFtm(int $ftm): self
    {
        $this->ftm = $ftm;

        return $this;
    }
}
