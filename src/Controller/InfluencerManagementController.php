<?php 

/**
 * Name: InfluencerManagementController.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file handle all the compute function of the influencer management dashboard of Bellybutton Group
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InfluencerManagementController extends AbstractController
{   //TODO extend the number of routes that connect to this controler
    //TODO figure out a way to secure the acess to this controler==> Maybe link it the same way as Dashboard
    //TODO figure out the service runner for TK; IG and TW (YT seems implemented) ==> Maybe implement a meta-runner?

    /**
     * @Route("InfluencerManagement/add", name="addInfluencer")
     */
    public function addInfluencer()
    {
        return $this->render('influencerManagement/add.html.twig');
    }
    /**
     * @Route("InfluencerMangement/", name="influencerView")
     */
    public function influencer()
    {
        return $this->render('influencerManagement/influencer.html.twig');
    }

    //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    /**
     * @Route("InfluencerManagement/delete", name="deleteInfluencer")
     */
    public function removeInfluencer()
    {
        return $this->render('influencerManagement/remove.html.twig');
    }

    // TODO make this as a "pop-up" or a subpage?
    /**
     * @Route("InfluencerManagement/modif", name="modifInfluencer")
     */
    public function modifInfluencer()
    {
        return $this->render('influencerManagement/modif.html.twig');
    }

    //TODO See if i can make this in pure PHP it can save me some time messing with Doctrine
    /**
     * @Route("InfluencerManagement/select", name="selectInfluencer")
     */
    public function selectInfluencer()
    {
        return $this-> render('influencerManagement/select.html.twig');
    }
    
    //---------------------------------------------------------------------------------------------------------------------------------
     //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    public function addAgency()
    {
        return $this-> render('influencerManagement/addAgency.html.twig');
    }
     //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    public function modifAgency()
    {
        return $this-> render('influencerManagement/modifAgency.html.twig');
    }
     //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    public function deleteAgency()
    {
        return $this-> render('influencerManagement/deleteAgency.html.twig');
    }
}