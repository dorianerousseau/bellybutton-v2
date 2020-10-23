<?php

/** 
 * Name: AddInfluencer.php
 * Author: Flavien MAcquignon
 * Date: 22/10/2020
 * Comment: this file is a fonctionnal class to retrieve all information of the Add Influencer function of the Influencer Management Dashboard
 */

namespace App\Entity\InfluenceurManagement;

class AddInfluencer
{
    private $fname;
    private $lname;
    private $mailpro;
    private $postalAdress;
    private $URLYT;
    private $URLIG;
    private $URLTW;
    private $URLTK;
    private $agencyId;
    private $picture_small;
    private $picture_large;
    private $catAudience;
    private $status;
    private $Sector;
    private $Description;
    private $Commentary;
    //------------------------------------------------------------------------
    public function setfname($fname)
    {
        $this->fname=$fname;
        return $this;
    }
    public function getfname(): ?string
    {
        return $this->fname;
    }
    public function setlname($lname)
  {
      $this->lname=$lname;
      return $this;
  }
    public function getlname(): ?string
   {
       return $this->lname;
   }
    public function setmailPro($mailpro)
   {
       $this->mailpro= $mailpro;
       return $this;
   }
    public function getmailPro(): ?string
   {
       return $this->mailpro;
   }
   
    public function setpostalAdress($postalAdress)
    {
        $this->postalAdress = $postalAdress;
        return $this;
    }
    public function getpostalAdress(): ?string
    {
        return $this->postalAdress;
    }
    public function setURLYT($URLYT)
    {
        $this->URLYT = $URLYT;
        return $this;
    }
    public function getURLYT(): ?string
    {
        return $this->URLYT;
    }
    public function setURLIG($URLIG)
    {
        $this->URLIG = $URLIG;
        return $this;
    }
    public function getURLIG(): ?string
    {
        return $this->URLIG;
    }
    public function setURLTW($URLTW)
    {
        $this->URLTW = $URLTW;
        return $this;
    }
    public function getURLTW(): ?string
    {
        return $this->URLTW;
    }
    public function setURLTK($URLTK)
    {
        $this->URLTK = $URLTK;
        return $this;
    }
    public function getURLTK(): ?string
    {
        return $this->URLTK;
    }
    public function setagencyId($agencyId)
    {
        $this->agencyId = $agencyId;
        return $this;
    }
    public function getagencyId(): ?int
    {
        return $this->agencyId;
    }
    //FIXME Delete null set
    public function setPictureSmall($picture_small)
    {
        echo('picture_small received');
        $picture_small=null;
    }
    public function getPictureSmall()
    {
        return $this->picture_small;
    }
    public function setPictureLarge($picture_large)
    {
        echo('picture_large received');
        $picture_large=null;
    }
    public function getPictureLarge()
    {
        return $this->picture_large;
    }
    public function setcatAudience($catAudience)
    {
        $this->catAudience = $catAudience;
        return $this;
    }
    public function getcatAudience(): ?int
    {
        return $this->catAudience;
    }
    public function setstatus($status)
    {
        $this->status = $status;
        return $this;
    }
    public function getstatus(): ?int
    {
        return $this->status;
    }
    public function setSector($Sector)
    {
        $this->Sector = $Sector;
        return $this;
    }
    public function getSector(): ?int
    {
        return $this->Sector;
    }
    public function setDescription($Description)
    {
        $this->Description = $Description;
        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->Description;
    }
    public function setCommentary($Commentary)
    {
        $this->Commentary = $Commentary;
        return $this;
    }
    public function getCommentary(): ?string
    {
        return $this->Commentary;
    }
}
