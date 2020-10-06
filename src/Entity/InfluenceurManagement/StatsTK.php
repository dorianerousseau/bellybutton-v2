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
     * @ORM\Column(type="integer")
     */
    private $nbrLikeTK;
    /**
     * @ORM\Column(type="integer")
     */
    private $nbrAboTK;
    /**
     * @ORM\Column(type="integer")
     */
    private $nbrComsTK;
    /**
     * @ORM\Column(type="integer")
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
}