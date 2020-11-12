<?php
/**
 * Name: StatsIG.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: Ce fichier est destiner à se connecter à la base de données BB_Central et effectuer les opérations concernant les perfomance d'un Influenceurs sur Instagram
 */
namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatsIGRepository")
 * @UniqueEntity("idStatsIG")
 */
class StatsIG
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluenceurManagement\Performance", mappedBy="idStatsIG")
     */
    private $idStatsIG;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likeIG;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrComsIG;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrAboIG;
    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\InfluencerManagement", inversedBy="idAudience")
     */
    private $idAudience;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    //Constructors


    public function getIdStatsIG(): ?int
    {
        return $this->idStatsIG;
    }

    public function getLikeIG(): ?int
    {
        return $this->likeIG;
    }

    public function setLikeIG(?int $likeIG): self
    {
        $this->likeIG = $likeIG;

        return $this;
    }

    public function getNbrComsIG(): ?int
    {
        return $this->nbrComsIG;
    }

    public function setNbrComsIG(?int $nbrComsIG): self
    {
        $this->nbrComsIG = $nbrComsIG;

        return $this;
    }

    public function getNbrAboIG(): ?int
    {
        return $this->nbrAboIG;
    }

    public function setNbrAboIG(?int $nbrAboIG): self
    {
        $this->nbrAboIG = $nbrAboIG;

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