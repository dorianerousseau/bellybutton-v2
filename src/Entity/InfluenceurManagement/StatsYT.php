<?php
/**
 * Name: StatsYT.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file is file destined to connect to the BB_Central Database and create a StatsYT table to save Youtube statistics
 */
namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatsYTRepository")
 * @UniqueEntity("idStatsYT")
 */
class StatsYT
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluenceurManagement\Performance", mappedBy="idStatsYT")
     */
    private $idStatsYT;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $EstimationsYT;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likeYT;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dislikeYT;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $viewYT;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbVid7YT;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbVid37YT;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbAboYT;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbComsYT;
    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\InfluencerManagement", inversedBy="idAudience")
     */
    private $idAudience;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getIdStatsYT(): ?int
    {
        return $this->idStatsYT;
    }

    public function getEstimationsYT(): ?int
    {
        return $this->EstimationsYT;
    }

    public function setEstimationsYT(?int $EstimationsYT): self
    {
        $this->EstimationsYT = $EstimationsYT;

        return $this;
    }

    public function getLikeYT(): ?int
    {
        return $this->likeYT;
    }

    public function setLikeYT(?int $likeYT): self
    {
        $this->likeYT = $likeYT;

        return $this;
    }

    public function getDislikeYT(): ?int
    {
        return $this->dislikeYT;
    }

    public function setDislikeYT(?int $dislikeYT): self
    {
        $this->dislikeYT = $dislikeYT;

        return $this;
    }

    public function getViewYT(): ?int
    {
        return $this->viewYT;
    }

    public function setViewYT(?int $viewYT): self
    {
        $this->viewYT = $viewYT;

        return $this;
    }

    public function getNbVid7YT(): ?int
    {
        return $this->nbVid7YT;
    }

    public function setNbVid7YT(?int $nbVid7YT): self
    {
        $this->nbVid7YT = $nbVid7YT;

        return $this;
    }

    public function getNbVid37YT(): ?int
    {
        return $this->nbVid37YT;
    }

    public function setNbVid37YT(?int $nbVid37YT): self
    {
        $this->nbVid37YT = $nbVid37YT;

        return $this;
    }

    public function getNbAboYT(): ?int
    {
        return $this->nbAboYT;
    }

    public function setNbAboYT(?int $nbAboYT): self
    {
        $this->nbAboYT = $nbAboYT;

        return $this;
    }

    public function getNbComsYT(): ?int
    {
        return $this->nbComsYT;
    }

    public function setNbComsYT(?int $nbComsYT): self
    {
        $this->nbComsYT = $nbComsYT;

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