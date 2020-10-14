<?php 

/**
 * Name: InfluencerManagementController.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file handle all the compute function of the influencer management dashboard of Bellybutton Group
 */
namespace App\Controller;

use App\Entity\User;
use App\Entity\Agency;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InfluencerManagementController extends AbstractController
{   //TODO extend the number of routes that connect to this controler
    //TODO figure out a way to secure the acess to this controler==> Maybe link it the same way as Dashboard
    //TODO figure out the service runner for TK; IG and TW (YT seems implemented) ==> Maybe implement a meta-runner?
   

    // TODO insert special user to the DB here
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
    public function influencerView()
    {
        //Query the number of user who is an influencer to populate $k and fill the do...while loop after
        $k=$this->extractColumnDB("SELECT COUNT(user_id) FROM user_role WHERE role_id=3", 0);
        
        //return a array of user_id where role==3
        //basically return all influencer id
        $stmt = $this->extractColumnDB("SELECT user_id FROM user_role WHERE role_id='3'", 0);
        
        // initialize variables for the loop
        $i=$k[0]-1;
        $j=0;

        // Loop to extract info of every influencer based on their id
        do{
        //here extract info from Doctrine to populate the template; $stmt holds all the id; $j act as a key tha move by ++ each loop
        $users[]= $this->getDoctrine()->getRepository(User::class)->find(($stmt[$j]));
        $Agency[]= $this->getAgency($stmt[$j]);
        $i--;
        $j++;
        }while($i>=0);
        return $this->render('influencerManagement/index.html.twig', ['users'=>$users,
                                                                      'Agency'=>$Agency ] );
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
    //---------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------------
   /**
    * Send a query to the database and extact a single column
    * @param $SQL: The SQL query
    * @param $numColumn: return this column in the array (start at zero)
    *
    * @return $stmt: a array of all row of the specified column in $numColumn
    */
    private function extractColumnDB(string $SQL, int $numColumn)
    {
        $PDO = new PDO(self::dsn, self::user, self::pass, self::options);
        $stmt=$PDO->query($SQL)->fetchAll(PDO::FETCH_COLUMN, $numColumn);
        $PDO=null;
        return $stmt;
    }

    private function getAgency(string $userid)
    {
        $idAgency=$this->getDoctrine()->getRepository(User::class)->find($userid)->getidAgency();
        $Agency=$this->getDoctrine()->getRepository(Agency::class)->find($idAgency);
        return $Agency;
    
    }
}