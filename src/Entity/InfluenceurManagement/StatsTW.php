<?php
/**
 * Name: StatsTW.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file is file destined to connect to the BB_Central Database and create a StatsTW table to save Twitch statistics
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
     * @ORM\Column(type="integer")
     */
    private $averageViewTW;
    /**
     * @ORM\Column(type="integer")
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
}
