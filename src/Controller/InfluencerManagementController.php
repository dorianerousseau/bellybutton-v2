<?php 

/**
 * Name: InfluencerManagementController.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file handle all the compute function of the influencer management dashboard of Bellybutton Group
 */
namespace App\Controller;

use App\Entity\User;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InfluencerManagementController extends AbstractController
{   //TODO extend the number of routes that connect to this controler
    //TODO figure out a way to secure the acess to this controler==> Maybe link it the same way as Dashboard
    //TODO figure out the service runner for TK; IG and TW (YT seems implemented) ==> Maybe implement a meta-runner?
   

    //FIXME issue with access right on the DATBASE; check doctrine Coonfig to fix it
    //Constant for PDO
    const host = '127.0.0.1';
    const port = '3306';
    const db   = 'bellybutton';
    const user = 'belly';
    const pass = 'belly1234&';
    const charset = 'utf8';

    const dsn = 'mysql:host='.self::host.'; port='.self::port.';dbname='.self::db.'';
    const options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    //----------------------------------------------------------------------------------
    // TODO Add a way to handles calls to the DB; maybe by using SQL script?
    // 
    /**
     * @Route("InfluencerManagement/add", name="addInfluencer")
     */
    public function addInfluencer()
    {
        return $this->render('influencerManagement/add.html.twig');
    }
    /**
     * @Route("InfluencerMangement/influencerView", name="influencerView")
     */
    public function influencer()
    {
        //TODO extract this function as another this function is just a call to print out; other function will do it
        //creating new PDO fill with const parameters
        $PDO = new PDO(self::dsn, self::user, self::pass, self::options);
        $PDO2 = new PDO(self::dsn, self::user, self::pass, self::options);

        //Query the number of user who is an influencer to populate $k and fill the do...while loop after
        $k=$PDO->query("SELECT COUNT(user_id) FROM user_role WHERE role_id=3")->fetchAll(PDO::FETCH_COLUMN, 0);
        $PDO=null;

        //return a array of user_id where role==3
        //basically return all influencer id
        $stmt = $PDO2->query("SELECT user_id FROM user_role WHERE role_id='3'")->fetchAll(PDO::FETCH_COLUMN, 0);
        $PDO2=null;

        // initialize variables for the loop
        $i=$k[0]-1;
        $j=0;

        // Loop to extract info of every influencer based on their id
        do{
        //here extract info from Doctrine to populate the template; $stmt holds all the id; $j act as a key tha move by ++ each loop
        $users[]= $this->getDoctrine()->getRepository(User::class)->find(($stmt[$j]));
        $i--;
        $j++;
        }while($i>=0);
        return $this->render('influencerManagement/index.html.twig', ['users'=>$users] );
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
    //TODO use iframe to render theses pages insides another as "pop-up" 
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