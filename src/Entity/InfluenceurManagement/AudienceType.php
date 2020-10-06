<?php

/**
 * Name: AudienceType.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file is file destined to connect to the BB_Central Database and create a AudienceType table to save stats about influencer
 */
namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AudienceTypeRepository")
 * @UniqueEntity("idAudience")
 */

 class AudienceType
 {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluencerManagement\StatsYT", mappedBy="idAudience")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluencerManagement\StatsIG", mappedBy="idAudience")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluencerManagement\StatsTW", mappedBy="idAudience")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluencerManagement\StatsTK", mappedBy="idAudience") 
     */
    private $idAudience;
    //Country are stored like this [CountryName]_[PercentageOfAudience].
    //If France is 45% of audience of an influencer, it must be stored like that: "France_45"
    /**
     * @ORM\Column(type="string")
     */
    private $country1;
        /**
     * @ORM\Column(type="string")
     */
    private $country2;
        /**
     * @ORM\Column(type="string")
     */
    private $country3;
    /**
     * @ORM\Column(type="integer")
     */
    private $world;
    /**
     * @ORM\Column(type="integer")
     */
    private $shareH;

    //Theses ages are stored as percentages

    //handle all ages under 13
    
    /**
     * @ORM\Column(type="integer")
     */
    private $less13;

    //handle all ages between 13 and 17
   
    /**
     * @ORM\Column(type="integer")
     */
    private $less17;

    //handle all ages between 18 and 24
   
    /**
     * @ORM\Column(type="integer")
     */
    private $less24;

    //handle all ages between 25 and 34
    
    /**
     * @ORM\Column(type="integer")
     */
    private $less34;

    //handle all ages between 35 and 44
   
    /**
     * @ORM\Column(type="integer")
     */
    private $less44;

   // handles all ages after 45
   
   /**
     * @ORM\Column(type="integer")
     */
    private $more45;

 }