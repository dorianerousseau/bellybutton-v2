<?php
/**
 * Name: StatsTW.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: Ce fichier est destiner à se connecter à la base de données BB_Central et effectuer les opérations concernant les perfomance d'un Influenceurs sur Twitch
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\RepositoryStatsTWRepository")
 * @UniqueEntity("idStatsTW")
 */
class StatsTW
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluenceurManagement", mappedBy="idStatsTW")
     */
    private $idStatsTW;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $averageViewTW;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrAboTW;
    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\InfluencerManagement", inversedBy="idAudience")
     */
    private $idAudience;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getIdStatsTW(): ?int
    {
        return $this->idStatsTW;
    }

    public function getAverageViewTW(): ?int
    {
        return $this->averageViewTW;
    }

    public function setAverageViewTW(?int $averageViewTW): self
    {
        $this->averageViewTW = $averageViewTW;

        return $this;
    }

    public function getNbrAboTW(): ?int
    {
        return $this->nbrAboTW;
    }

    public function setNbrAboTW(?int $nbrAboTW): self
    {
        $this->nbrAboTW = $nbrAboTW;

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
