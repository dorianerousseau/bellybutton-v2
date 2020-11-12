<?php

/**
 * Name: VenteIG.php
 * Author: Flavien Macquignon
 * Comment: Ce fichier est destiner à se connecter à la base de données BB_Central et effectuer les opérations concernant les informations de vente d'un Influenceurs sur Instagram
 */

namespace App\Entity\InfluenceurManagement;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VenteIGRepository")
 * @UniqueEntity("id")
 */
class VenteIG
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluenceurManagement\Performance", mappedBy="idVenteIG")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $CachetPost;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $MargePost;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $CachetStory;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $MargeStory;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $CachetIGTV;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $MargeIGTV;

    //-----------------------------------------------------------

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getCachetPost(): ?int
    {
        return $this->CachetPost;
    }
    public function setCachetPost(int $CachetPost)
    {
        $this->CachetPost = $CachetPost;
        return $this;
    }

    public function getMargePost(): ?int
    {
        return $this->MargePost;
    }

    public function setMargePost(int $MargePost)
    {
        $this->MargePost = $MargePost;
        return $this;
    }

    public function getCachetStory(): ?int
    {
        return $this->CachetStory;
    }
    public function setCachetStory(int $CachetStory)
    {
        $this->CachetStory = $CachetStory;
        return $this;
    }

    public function getMargeStory(): ?int
    {
        return $this->MargeStory;
    }
    public function setMargeStory(int $MargeStory)
    {
        $this->MargeStory = $MargeStory;
        return $this;
    }
    public function getCachetIGTV(): ?int
    {
        return $this->CachetIGTV;
    }
    public function setCachetIGTV(int $CachetIGTV)
    {
        $this->CachetIGTV = $CachetIGTV;
        return $this;
    }

    public function getMargeIGTV(): ?int
    {
        return $this->MargeIGTV;
    }
    public function setMargeIGTV(int $MargeIGTV)
    {
        $this->MargeIGTV = $MargeIGTV;
        return $this;
    }
}
