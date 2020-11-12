<?php

/**
 * Name: AudienceType.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: Ce fichier est destiner à se connecter à la base de données BB_Central et effectuer les opérations concernant les Audiences  
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
   private $shareM;

   //Theses ages are stored as percentages

   //handle all ages under 13

   /**
    * @ORM\Column(type="integer", nullable=true)
    */
   private $less13;

   //handle all ages between 13 and 17

   /**
    * @ORM\Column(type="integer", nullable=true)
    */
   private $less17;

   //handle all ages between 18 and 24

   /**
    * @ORM\Column(type="integer", nullable=true)
    */
   private $less24;

   //handle all ages between 25 and 34

   /**
    * @ORM\Column(type="integer", nullable=true)
    */
   private $less34;

   //handle all ages between 35 and 44

   /**
    * @ORM\Column(type="integer", nullable=true)
    */
   private $less44;

   // handles all ages after 45

   /**
    * @ORM\Column(type="integer", nullable=true)
    */
   private $more45;

   //constructor
   public function getcountry1(): ?string
   {
      return $this->country1;
   }

   public function setcountry1(string $country1)
   {
      $this->country1 = $country1;
      return $this;
   }

   public function getcountry2(): ?string
   {
      return $this->country2;
   }
   public function setcountry2(string $country2)
   {
      $this->country2 = $country2;
      return $this;
   }
   public function getcountry3(): ?string
   {
      return $this->country3;
   }
   public function setcountry3(string $country3)
   {
      $this->country3 = $country3;
      return $this;
   }
   public function getworld(): ?int
   {
      return $this->world;
   }
   public function setworld(int $world)
   {
      $this->world = $world;
      return $this;
   }

   public function getshareM(): ?int
   {
      return $this->shareM;
   }

   public function setshareM(int $shareM)
   {
      $this->shareM = $shareM;
      return $this;
   }

   public function getless13(): ?int
   {
      return $this->less13;
   }

   public function setless13(int $less13)
   {
      $this->less13 = $less13;
      return $this;
   }

   public function getless17(): ?int
   {
      return $this->less17;
   }
   public function setless17(int $less17)
   {
      $this->less17 = $less17;
      return $this;
   }
   public function getless24(): ?int
   {
      return $this->less24;
   }
   public function setless24(int $less24)
   {
      $this->less24 = $less24;
      return $this;
   }

   public function getless34(): ?int
   {
      return $this->less34;
   }
   public function setless34(int $less34)
   {
      $this->less34 = $less34;
      return $this;
   }

   public function getless44(): ?int
   {
      return $this->less44;
   }
   public function setless44(int $less44)
   {
      $this->less44 = $less44;
      return $this->less44;
   }
   public function getmore45(): ?int
   {
      return $this->more45;
   }
   public function setmore45(int $more45)
   {
      $this->more45 = $more45;
      return $this;
   }

   public function getIdAudience(): ?int
   {
       return $this->idAudience;
   }
}