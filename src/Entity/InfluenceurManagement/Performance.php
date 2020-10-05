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
   */
  private $idStatsYT;
  /**
   * @ORM\Column(type="integer")
   */
  private $idStatsIG;
  /**
   * @ORM\Column(type="integer")
   */
  private $idStatsTW;
  /**
   * @ORM\Column(type="integer")
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

  // TODO figure out a path to add here and how to use it on output
  /**
   * @ORM\Column(type="string")
   */
  private $pictureLarge;
  /**
   * @ORM\Column(type="string")
   */
  private $pictureSmall;
}
