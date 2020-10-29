<?php

/**
 * Name: VenteTW.php
 * Author: Flavien Macquignon
 * Date: 28/10/2020
 * Comment: This file is used to store billing information about an influencer about Twitch
 */

namespace App\Entity\InfluenceurManagement;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\VenteTWRepository")
 * @UniqueEntity("id")
 */
class VenteTW
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluenceurManagement\Performance", mappedBy="idVenteTW")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $CachetPDP;

    /**
     * @ORM\Column(type="integer", length=2)
     * @Assert\NotBlank
     */
    private $MargePDP;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $CachetSponso;

    /**
     * @ORM\Column(type="integer", length=2)
     * @Assert\NotBlank
     */
    private $MargeSponso;

    //-----------------------------------------------------------

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCachetPDP(): ?int
    {
        return $this->CachetPDP;
    }
    public function setCachetPDP(int $CachetPDP)
    {
        $this->CachetPDP = $CachetPDP;
        return $this;
    }
    public function getMargePDP(): ?int
    {
        return $this->MargePDP;
    }
    public function setMargeDPD(int $MargePDP)
    {
        $this->MargePDP = $MargePDP;
        return $this;
    }

    public function getCachetSponso(): ?int
    {
        return $this->CachetSponso;
    }
    public function setCachetSponso(int $CachetSponso)
    {
        $this->CachetSponso=$CachetSponso;
        return $this;
    }

    public function getMargeSponso(): ?int
    {
        return $this->MargeSponso;
    }

    public function setMargeSponso(int $MargeSponso)
    {
        $this->MargeSponso=$MargeSponso;
        return $this;
    }

    public function setMargePDP(int $MargePDP): self
    {
        $this->MargePDP = $MargePDP;

        return $this;
    }
}
