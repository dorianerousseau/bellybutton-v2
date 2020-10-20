<?php 

/**
 * Name: InfluencerManagementController.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file handle all the compute function of the influencer management dashboard of Bellybutton Group
 */
namespace App\Controller;

use App\Entity\User;
use App\Entity\InfluenceurManagement\Agency;
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
        //This organisation is similar as the one in influencerView() below check-it out for more info
        //This is needed to return every Agency in the Database
        $k=$this->extractColumnDB("SELECT COUNT(id) FROM agency", 0);
        $stmt=$this->extractColumnDB("SELECT id FROM agency", 0);
        $i=$k[0]-1;
        $j=0;
        do{
            $agency[]=$this->getDoctrine()->getRepository(Agency::class)->find(($stmt[$j]));
            $i--;
            $j++;
        }while($i>0);
        return $this->render('influencerManagement/add.html.twig', ['Agencys'=>$agency]);
    }
    /**
     * List all the influencer (Role==3 in the Database) and display it in the \templates\influencerManagement\index.html.twig page
     */
    /**
     * @Route("InfluencerManagement/influencerView", name="influencerView")
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

    //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage (iframe)
    /**
     * @Route("InfluencerManagement/delete", name="deleteInfluencer")
     */
    public function removeInfluencer()
    {
        return $this->render('influencerManagement/remove.html.twig');
    }

    // TODO make this as a "pop-up" or a subpage? (iframe?)
    /**
     * @Route("InfluencerManagement/modif", name="modifInfluencer")
     */
    public function modifInfluencer()
    {
        return $this->render('influencerManagement/modif.html.twig');
    }

    
    /**
     * @Route("InfluencerManagement/select?user={userId}", name="selectInfluencer")
     */
    public function selectInfluencer(int $userId)
    {
       $user= $this->getDoctrine()->getRepository(User::class)->find($userId);
        return $this-> render('influencerManagement/select.html.twig',['user'=>$user]);
    }
    
    //---------------------------------------------------------------------------------------------------------------------------------
    //TODO use iframe to render theses pages insides another as "pop-up" 
    //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    public function addAgency()
    {
        return $this-> render('influencerManagement/addAgency.html.twig');
    }
    /**
     * @Route("InfluencerManagement/select?agency={agencyId}", name="selectAgency")
     */
    public function selectAgency($agencyId)
    {
        if($agencyId=="Sans Agence")
        {
            return $this->influencerView();
        }
        else{
            //extract the id of the agency using a SQL query
            $agency=$this->extractColumnDB("SELECT id FROM agency WHERE name_agency='".$agencyId."'", 0);
            //use the agencyId to extract an Agency object
            $Agency = $this->getDoctrine()->getRepository(Agency::class)->find($agency[0]);
            
            return $this-> render('influencerManagement/selectAgency.html.twig',['Agency'=>$Agency]);
        }

    }
    /**
     * @Route("InfluencerManagement/modif?agency={agencyId}, name="modifAgency")
     */
     //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    public function modifAgency($idAgency)
    {
        return $this-> render('influencerManagement/modifAgency.html.twig');
    }
     //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    public function deleteAgency($idAgency)
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
    /**
     * Retrieve the Agency object of the userid passed in parameter
     * @param $userid: the userid of the user that you want to retrieve the Agency
     * @return $AgencyN: if the querying is null; return an Agency Object with "Sans Agence" as Agency Name
     * @return $Agency: if there is an Agency in the DataBase, return an Agency Object filled with information from the Agency Table 
     */
    private function getAgency(string $userid)
    {
        $idAgency=$this->getDoctrine()->getRepository(User::class)->find($userid)->getidAgency();
        
        $Agency=$this->getDoctrine()->getRepository(Agency::class)->find($idAgency);
        if ($Agency==null)
        {
            $AgencyN=new Agency();
            return $AgencyN->setnameAgency("Sans Agence");
        }
        else{
        return $Agency;
        }
    
    }
}