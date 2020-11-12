<?php

/**
 * Name: VenteYT.php
 * Author: Flavien Macquignon
 * Date: 28/10/2020
 * Comment: Ce fichier est destiner à se connecter à la base de données BB_Central et effectuer les opérations concernant les informations de vente d'un Influenceurs sur Youtube 
 */

namespace App\Entity\InfluenceurManagement;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VenteYTRepository")
 * @UniqueEntity("id")
 */
class VenteYT
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluenceurManagement\Performance", mappedBy="idVenteYT")
     */
    private $id;

    // TODO check length pour $Garantie et $Estimation
    /**
     * @ORM\Column(type="integer")
     */
    private $Garantie;

    /**
     * @ORM\Column(type="integer")
     */
    private $Estimation;

    /**
     * @ORM\Column(type="integer", length=6)
     * @Assert\NotBlank
     */
    private $CachetInte;

    /**
     * @ORM\Column(type="integer", length=2)
     * @Assert\NotBlank
     */
    private $MargeInte;

    /**
     * @ORM\Column(type="integer", length=6)
     * @Assert\NotBlank
     */
    private $CachetVidDe;

    /**
     * @ORM\Column(type="integer", length=2)
     * @Assert\NotBlank
     */
    private $MargeVidDe;

    //-----------------------------------------------------
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGarantie(): ?int
    {
        return $this->Garantie;
    }

    public function setGarantie(int $Garantie)
    {
        $this->Garantie=$Garantie;
        return $this;
    }

    public function getEstimation(): ?int
    {
        return $this->Estimation;
    }

    public function setEstimation(int $Estimation)
    {
        $this->Estimation=$Estimation;
        return $this;
    }

    public function getCachetInte(): ?int
    {
        return $this->CachetInte;
    }

    public function setCachetInte($CachetInte)
    {
        $this->CachetInte=$CachetInte;
        return $this;
    }

    public function getMargeInte(): ?int
    {
        return $this->MargeInte;
    }

    public function setMargeInte(int $MargeInte)
    {
        $this->MargeInte=$MargeInte;
        return $this;
    }

    public function getCachetVidDe(): ?int
    {
        return $this->CachetVidDe;
    }

    public function setCachetVidDe(int $CachetVidDe)
    {
        $this->CachetVidDe=$CachetVidDe;
        return $this;
    }

    public function getMargeVidDe(): ?int
    {
        return $this->MargeVidDe;
    }

    public function setMargeVidDe(int $MargeVidDe)
    {
        $this->MargeVidDe=$MargeVidDe;
        return $this;
    }

}
