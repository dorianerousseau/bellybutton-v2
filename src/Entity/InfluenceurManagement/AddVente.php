<?php

/**
 * Name: AddVente.php
 * Author: Flavien Macquignon
 * Date: 06/11/2020
 * Comment: this file is a fonctionnal class used to retrieve information about sales of an influencer
 */
namespace App\Entity\InfluenceurManagement;

class AddVente
{
    //Youtube variables
    private $GarantieYT;
    private $EstimationYT;
    private $CachetInteYT;
    private $MargeInteYT;
    private $CachetVidDeYT;
    private $MargeVidDeYT;

    //Instagram Variables
    private $CachetPostIG;
    private $MargePostIG;
    private $CachetStoryIG;
    private $MargeStoryIG;
    private $CachetIGTV;
    private $MargeIGTV;

    //Twitch Variables
    private $CachetPDPTW;
    private $MargePDPTW;
    private $CachetSponsoTW;
    private $MargeSponsoTW;

    //Tiktok Variables
    private $CachetPostTK;
    private $MargePostTK;

    //---------------------------------------------------------------
   
   // Youtube
    public function setGarantieYT (int $GarantieYT)
    {
        $this->GarantieYT=$GarantieYT;
        return $this;
    }
    public function getGarantieYT(): ?int
    {
        return $this->GarantieYT;
    }
    public function setEstimationYT(int $EstimationYT)
    {
        $this->EstimationYT=$EstimationYT;
        return $this;
    }
    public function getEstimationYT(): ?int
    {
        return $this->EstimationYT;
    }

    public function setCachetInteYT(int $CachetInteYT)
    {
        $this->CachetInteYT=$CachetInteYT;
        return $this;
    }

    public function getCachetInteYT(): ?int
    {
        return $this->CachetInteYT;
    }
    public function setMargeInteYT(int $MargeInteYT)
    {
        $this->MargeInteYT=$MargeInteYT;
        return $this;
    }
    public function getMargeInteYT(): ?int
    {
        return $this->MargeInteYT;
    }
    public function setCachetVidDeYT(int $CachetVidDeYT)
    {
        $this->CachetVidDeYT=$CachetVidDeYT;
        return $this;
    }
    public function getCachetVidDeYT(): ?int
    {
        return $this->CachetVidDeYT;
    }
    public function setMargeVidDeYT(int $MargeVidDeYT)
    {
        $this->MargeVidDeYT=$MargeVidDeYT;
        return $this;
    }
    public function getMargeVidDeYT(): ?int
    {
        return $this->MargeVidDeYT;
    }


    // Instagram
    public function setCachetPostIG(int $CachetPostIG)
    {
        $this->CachetPostIG=$CachetPostIG;
        return $this;
    }
    public function getCachetPostIG(): ?int
    {
        return $this->CachetPostIG;
    }
    public function setMargePostIG(int $MargePostIG)
    {
        $this->MargePostIG=$MargePostIG;
        return $this;
    }
    public function getMargePostIG(): ?int
    {
        return $this->MargePostIG;
    }
    public function setCachetStoryIG(int $CachetStoryIG)
    {
        $this->CachetStoryIG=$CachetStoryIG;
        return $this;
    }
    public function getCachetStoryIG(): ?int
    {
        return $this->CachetStoryIG;
    }
    public function setMargeStoryIG(int $MargeStoryIG)
    {
        $this->MargeStoryIG=$MargeStoryIG;
        return $this;
    }
    public function getMargeStoryIG(): ?int
    {
        return $this->MargeStoryIG;
    }
    public function setCachetIGTV(int $CachetIGTV)
    {
        $this->CachetIGTV=$CachetIGTV;
        return $this;
    }
    public function getCachetIGTV(): ?int
    {
        return $this->CachetIGTV;
    }
    public function setMargeIGTV(int $MargeIGTV)
    {
        $this->MargeIGTV=$MargeIGTV;
        return $this;
    }
    public function getMargeIGTV(): ?int
    {
        return $this->MargeIGTV;
    }

    // Twitch
    public function setCachetPDPTW(int $CachetPDPTW)
    {
        $this->CachetPDPTW=$CachetPDPTW;
        return $this;
    }
    public function getCachetPDPTW(): ?int
    {
        return $this->CachetPDPTW;
    }
    public function setMargePDPTW(int $MargePDPTW)
    {
        $this->MargePDPTW=$MargePDPTW;
        return $this;
    }
    public function getMargePDPTW(): ?int
    {
        return $this->MargePDPTW;
    }
    public function setCachetSponsoTW(int $CachetSponsoTW)
    {
        $this->CachetSponsoTW=$CachetSponsoTW;
        return $this;
    }
    public function getCachetSponsoTW(): ?int
    {
        return $this->CachetSponsoTW;
    }
    public function setMargeSponsoTW(int $MargeSponsoTW)
    {
        $this->MargeSponsoTW=$MargeSponsoTW;
        return $this;
    }
    public function getMargeSponsoTW(): ?int
    {
        return $this->MargeSponsoTW;
    }

    // Tiktok
    public function setCachetPostTK(int $CachetPostTK)
    {
        $this->CachetPostTK=$CachetPostTK;
        return $this;
    }
    public function getCachetPostTK(): ?int
    {
        return $this->CachetPostTK;
    }
    public function setMargePostTK(int $MargePostTK)
    {
        $this->MargePostTK=$MargePostTK;
        return $this;
    }
    public function getMargePostTK(): ?int
    {
        return $this->MargePostTK;
    }

}