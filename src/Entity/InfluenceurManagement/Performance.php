<?php

/**
 * Name: Performance.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: Ce fichier est destiner à se connecter à la base de données BB_Central et effectuer les opérations concernant les "Performances" d'un Influenceur
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("id")
 */

class Performance
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $idUser;

  // TODO Corriger les integer de chaque idStats; doivent être des String
  /**
   * @ORM\Column(type="integer", nullable=true)
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\StatsYT", inversedBy="idStatsYT")
   */
  private $idStatsYT;
  /**
   * @ORM\Column(type="integer", nullable=true)
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\StatsIG", inversedBy="idStatsIG")
   */
  private $idStatsIG;
  /**
   * @ORM\Column(type="integer", nullable=true)
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\StatsTW", inversedBy="idStatsTW")
   */
  private $idStatsTW;
  /**
   * @ORM\Column(type="integer", nullable=true)
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\StatsTK", inversedBy="idStatsTK")
   */
  private $idStatsTK;
  /**
   * @ORM\Column(type="integer")
   */
  private $audienceCategorie;
  /**
   * @ORM\Column(type="integer")
   */
  private $status;
  /**
   * @ORM\Column(type="integer")
   */
  private $sector;
  /**
   * @ORM\Column(type="integer", length=2, nullable=true)
   */
  private $margin;

  //WARN ici sont stocker les chemins d'accès aux photos
  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $pictureLarge;
  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $pictureSmall;

  //TODO Creér les constructeurs
  /**
   * @ORM\Column(type="integer", nullable=true)
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\VenteYT", inversedBy="id")
   */
  private $idVenteYT;

  /**
   * @ORM\Column(type="integer")
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\VenteTW", inversedBy="id")
   */
  private $idVenteTW;

  /**
   * @ORM\Column(type="integer")
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\VenteTK", inversedBy="id")
   */
  private $idVenteTK;

  /**
   * @ORM\Column(type="integer")
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\VenteIG", inversedBy="id")
   */
  private $idVenteIG;



  public function getaudienceCategorie(): ?int
  {
    return $this->audienceCategorie;
  }
  public function setaudienceCategorie(int $audienceCategorie)
  {
    $this->audienceCategorie = $audienceCategorie;
    return $this;
  }
  public function getstatus(): ?int
  {
    return $this->status;
  }
  public function setstatus(int $status)
  {
    $this->status = $status;
    return $this;
  }
  public function getsector(): ?int
  {
    return $this->sector;
  }
  public function setsector(int $sector)
  {
    $this->sector = $sector;
    return $this;
  }

  public function getmargin(): ?int
  {
    return $this->margin;
  }
  public function setmargin(int $margin)
  {
    $this->margin = $margin;
    return $this;
  }

  public function getpictureLarge(): ?string
  {
    return $this->pictureLarge;
  }
  public function setpictureLarge(string $pictureLarge)
  {
    $this->pictureLarge = $pictureLarge;
    return $this;
  }
  public function getpictureSmall(): ?string
  {
    return $this->pictureSmall;
  }
  public function setpictureSmall(string $pictureSmall)
  {
    $this->pictureSmall = $pictureSmall;
    return $this;
  }

  public function getIdUser(): ?int
  {
    return $this->idUser;
  }

  public function getIdStatsYT(): ?int
  {
    return $this->idStatsYT;
  }

  public function setIdStatsYT(?int $idStatsYT): self
  {
    $this->idStatsYT = $idStatsYT;

    return $this;
  }

  public function getIdStatsIG(): ?int
  {
    return $this->idStatsIG;
  }

  public function setIdStatsIG(?int $idStatsIG): self
  {
    $this->idStatsIG = $idStatsIG;

    return $this;
  }

  public function getIdStatsTW(): ?int
  {
    return $this->idStatsTW;
  }

  public function setIdStatsTW(?int $idStatsTW): self
  {
    $this->idStatsTW = $idStatsTW;

    return $this;
  }

  public function getIdStatsTK(): ?int
  {
    return $this->idStatsTK;
  }

  public function setIdStatsTK(?int $idStatsTK): self
  {
    $this->idStatsTK = $idStatsTK;

    return $this;
  }
}
