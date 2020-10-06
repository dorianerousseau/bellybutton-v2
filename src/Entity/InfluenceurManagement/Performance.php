<?php
/**
 * Name: Performance.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file is file destined to connect to the BB_Central Database and create a Performance table for saving statistics
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
  // TODO link that to userID using the success() function inside InfluencerController.php
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $idUser;
  /**
   * @ORM\Column(type="integer")
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\StatsYT", inversedBy="idStatsYT")
   */
  private $idStatsYT;
  /**
   * @ORM\Column(type="integer")
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\StatsIG", inversedBy="idStatsIG")
   */
  private $idStatsIG;
  /**
   * @ORM\Column(type="integer")
   * @ORM\ManyToOne(targetEntity="App\Entity\InfluenceurManagement\StatsTW", inversedBy="idStatsTW")
   */
  private $idStatsTW;
  /**
   * @ORM\Column(type="integer")
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
   * @ORM\Column(type="integer", length=2)
   */
  private $margin;

  // TODO figure out a path to add here and how to use it on output; also how to input the file
  /**
   * @ORM\Column(type="string")
   */
  private $pictureLarge;
  /**
   * @ORM\Column(type="string")
   */
  private $pictureSmall;

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

  // TODO check how to upload the picture to the server
  public function setpictureLarge(string $pictureLarge)
  {
    $this->pictureLarge = $pictureLarge;
    return $this;
  }
  public function getpictureSmall(): ?string
  {
    return $this->pictureSmall;
  }
  //TODO check the todo of setpictureLarge()
  public function setpictureSmall(string $pictureSmall)
  {
    $this->pictureSmall = $pictureSmall;
    return $this;
  }

}
