<?php
/**
 * Name: StatsTK.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file is file destined to connect to the BB_Central Database and create a StatsTK table to save Tiktok statistics
 */
namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatsTKRepository")
 * @UniqueEntity("idStatsTK")
 */
class StatsTK
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluenceurManagement\StatsTK", mappedBy="idStatsTK")
     */
    private $idStatsTK;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrLikeTK;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrAboTK;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrComsTK;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrVuesTK;
    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\InfluencerManagement", inversedBy="idAudience")
     */
    private $idAudience;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getIdStatsTK(): ?int
    {
        return $this->idStatsTK;
    }

    public function getNbrLikeTK(): ?int
    {
        return $this->nbrLikeTK;
    }

    public function setNbrLikeTK(?int $nbrLikeTK): self
    {
        $this->nbrLikeTK = $nbrLikeTK;

        return $this;
    }

    public function getNbrAboTK(): ?int
    {
        return $this->nbrAboTK;
    }

    public function setNbrAboTK(?int $nbrAboTK): self
    {
        $this->nbrAboTK = $nbrAboTK;

        return $this;
    }

    public function getNbrComsTK(): ?int
    {
        return $this->nbrComsTK;
    }

    public function setNbrComsTK(?int $nbrComsTK): self
    {
        $this->nbrComsTK = $nbrComsTK;

        return $this;
    }

    public function getNbrVuesTK(): ?int
    {
        return $this->nbrVuesTK;
    }

    public function setNbrVuesTK(?int $nbrVuesTK): self
    {
        $this->nbrVuesTK = $nbrVuesTK;

        return $this;
    }

    public function getIdAudience(): ?int
    {
        return $this->idAudience;
    }

    public function setIdAudience(int $idAudience): self
    {
        $this->idAudience = $idAudience;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}