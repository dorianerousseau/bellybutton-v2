<?php

/**
 * Name: VenteTK.php
 * Author: Flavien Macquignon
 * Date: 28/10/2020
 * Comment:  This file is used to store billing information about an influencer about TikTok
 */

namespace App\Entity\InfluenceurManagement;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VenteTKRepository")
 * @UniqueEntity("id")
 */
class VenteTK
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\InfluenceurManagement\Performance", mappedBy="idVenteTK")
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
        $this->CachetPost=$CachetPost;
        return $this;
    }

    public function getMargePost(): ?int
    {
        return $this->MargePost;
    }
    public function setMargePost(int $MargePost)
    {
        $this->MargePost=$MargePost;
        return $this;
    }
}
