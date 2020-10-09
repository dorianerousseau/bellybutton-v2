<?php
/**
 * Name: InfoContact.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file is file destined to connect to the BB_Central Database and create a Contact table for contacting purposes
 */
namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InfoContactRepository")
 * @UniqueEntity("id")
 */
class infoContact 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="idInfoContact")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $mailPro;
    /**
     * @ORM\Column(type="integer", length=17, nullable=true)
     * @Assert\NotBlank
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $postalAdress;
    /**
     * @ORM\Column(type="string", length=17, nullable=true)
     */
    private $numWhatsApp;
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $preferedContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentary;

    public function getmailPro(): ?string
    {
        return $this->mailPro;
    }
    public function setmailPro(string $mailPro): self
    {
        $this->mailPro = $mailPro;
        return $this;
    }
    public function getphoneNumber(): ?int
    {
        return $this->phoneNumber;
    }
    public function setphoneNumber(int $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }
    public function getpostalAdress(): ?string
    {
        return $this->postalAdress;
    }
    public function setpostalAdress(string $postalAdress)
    {
        $this->postalAdress= $postalAdress;
        return $this;
    }
    public function getnumWhatsApp(): ?string
    {
        return $this->numWhatsApp;
    }
    public function setnumWhatsApp( string $numWhatsApp)
    {
        $this->numWhatsApp = $numWhatsApp;
        return $this;
    }

    public function getpreferredContact(): ?string
    {
        return $this->preferedContact;
    }

    public function setpreferedContact(string $preferedContact)
    {
        $this->preferedContact = $preferedContact;
        return $this;
    }

    public function getcommentary(): ?string
    {
        return $this->commentary;
    }
    public function setcommentary(string $commentary)
    {
        $this->commentary =$commentary;
        return $this;
    }
}