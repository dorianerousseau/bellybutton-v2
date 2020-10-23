<?php

/**
 * Name: InfluencerManagementController.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file handle all the compute function of the influencer management dashboard of Bellybutton Group
 */

namespace App\Controller;

use App\Entity\InfluenceurManagement\AddInfluencer;
use App\Entity\User;
use App\Entity\InfluenceurManagement\Agency;
use App\Entity\StatsIG;
use App\Entity\StatsTK;
use App\Entity\StatsTW;
use App\Entity\StatsYT;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InfluencerManagementController extends AbstractController
{   //TODO figure out a way to secure the acess to this controler==> Maybe link it the same way as Dashboard
    //TODO figure out the service runner for TK; IG and TW (YT seems implemented) ==> Maybe implement a meta-runner?


    // TODO insert special user to the DB here
    //Constant for PDO connection
    const host = '127.0.0.1';
    const port = '3306';
    const db   = 'bellybutton';
    const user = 'belly';
    const pass = 'belly1234&';
    const charset = 'utf8';

    const dsn = 'mysql:host=' . self::host . '; port=' . self::port . ';dbname=' . self::db . '';
    const options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    //----------------------------------------------------------------------------------
    //TODO check how to add this to the database
    /**
     * @Route("InfluencerManagement/add", name="addInfluencer")
     */
    public function addInfluencer(Request $request)
    {
        $k=0;
        // FIXME issue with extraction from the DB; i need an array[nomAgence=>id]
        $nbrAgences=$this->extractColumnDB('SELECT COUNT(id) FROM agency', 0);
        $Agencyid=$this->extractColumnDB('SELECT id FROM agency', 0);
        $AgencyName=$this->extractColumnDB('SELECT name_agency FROM agency',0);
        $choiceAgency=['Sans Agence'=>null];
        do{
        $tempArray=[$AgencyName[$k] => $Agencyid[$k]];
        $choiceAgency=array_merge($choiceAgency, $tempArray);
        $k++;
        }while($k<$nbrAgences[0]);
        
        $add = new AddInfluencer();
        $form=$this->createFormBuilder($add)
            ->add('fname', TextType::class)
            ->add('lname', TextType::class)
            ->add('mailpro', TextType::class)
            ->add('URLYT', TextType::class)
            ->add('URLIG', TextType::class)
            ->add('URLTW', TextType::class)
            ->add('URLTK', TextType::class)
            ->add('agencyId', ChoiceType::class, [
                'choices'  => $choiceAgency,
            ])
            //TODO add picture handling
            ->add('picture_small', FileType::class)
            ->add('picture_large', FileType::class)
            ->add('catAudience', ChoiceType::class,[
               'choices'=> 
               ['Aucune'=>"10",
                'G (0 - 50K)' =>"11",
                'F (50 - 150K)'=>"12",
                'E (150 - 200K)'=>'13',
                'D (250 - 350K)'=>'14',
                'C (350 - 500K)'=>'15',
                'B (500K - 1M)'=>'16',
                'A (1M > )'=> '17']
            ])

            ->add('status', IntegerType::class)
            ->add('Sector', ChoiceType::class,[
                'choices'=>
                [
                    'Auto'=>'0',
                    'Agriculture'=>'1',
                    'ASMR'=>'2',
                    'Art'=>'3',
                    'Beauté'=>'4',
                    'Cinéma'=>'5',
                    'Divertissement'=>'6',
                    'Deco'=>'7',
                    'Développement'=>'8',
                    'Espace'=>'9',
                    'Famille'=>'10',
                    'Food'=>'11',
                    'Foot'=>'12',
                    'Gaming'=>'13',
                    'Histoire'=>'14',
                    'Home'=>'15',
                    'Humour'=>'16',
                    'Lifestyle'=>'17',
                    'Manga'=>'18',
                    'Musique'=>'19',
                    'Mode'=>'20',
                    'Pêche'=>'21',
                    'Sport'=>'22',
                    'Science'=>'23',
                    'Tech'=>'24',
                    'Voyage'=>'25'

                ]
            ])
            ->add('Description', TextType::class)
            ->add('Commentary', TextType::class)
            ->getForm();

            $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        
        $add = $form->getData();
        //TODO add the influencer to the DB ==> redirect to SelectInfluencer with the specified userID
        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        // $entityManager = $this->getDoctrine()->getManager();
        // $entityManager->persist($task);
        // $entityManager->flush();

        return $this->redirectToRoute('task_success');
    }

        return $this->render('influencerManagement/add.html.twig', [
            'Form' => $form->createView()
        ]);
    }
    // TODO figure out how to print only 10 influencer at a time ==> Maybe by making this an extends of another page and reload only this part (aka the tab)
    /**
     * List all the influencer (Role==3 in the Database) and display it in the \templates\influencerManagement\index.html.twig page
     */
    /**
     * @Route("InfluencerManagement/influencerView", name="influencerView")
     */
    public function influencerView()
    {
        //Query the number of user who is an influencer to populate $k and fill the do...while loop after
        $k = $this->extractColumnDB("SELECT COUNT(user_id) FROM user_role WHERE role_id=3", 0);

        //return a array of user_id where role==3
        //basically return all influencer id
        $stmt = $this->extractColumnDB("SELECT user_id FROM user_role WHERE role_id='3'", 0);

        // initialize variables for the loop
        $i = $k[0] - 1;
        $j = 0;

        // Loop to extract info of every influencer based on their id
        do {
            //here extract info from Doctrine to populate the template; $stmt holds all the id; $j act as a key tha move by ++ each loop
            $users[] = $this->getDoctrine()->getRepository(User::class)->find(($stmt[$j]));
            $Agency[] = $this->getAgency($stmt[$j]);
            $i--;
            $j++;
        } while ($i >= 0);
        return $this->render('influencerManagement/index.html.twig', [
            'users' => $users,
            'Agency' => $Agency
        ]);
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
    //TODO figure out how make the search with param
    // Search is effectued directly into the Database trough a SQL query and concerned user are extracted by doctrine based on their userId
    public function searchInfluencer()
    {
    }

    //TODO Send a User, a Agency, a Performance, a Stats (based on null) and a catAudience object to the template
    //TODO extract theses objects based on history (just extract lastest update and make compute based on that)
    //TODO Make compute to process data
    //TODO handle V30 computing
    //TODO figure out how to print out history
    /**
     * @Route("InfluencerManagement/select?user={userId}", name="selectInfluencer")
     */
    public function selectInfluencer(int $userId)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);
        return $this->render('influencerManagement/select.html.twig', ['user' => $user]);
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    //TODO use iframe to render theses pages insides another as "pop-up" 
    //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    public function addAgency()
    {
        return $this->render('influencerManagement/addAgency.html.twig');
    }
    /**
     * @Route("InfluencerManagement/select?agency={agencyId}", name="selectAgency")
     */
    public function selectAgency($agencyId)
    {
        if ($agencyId == "Sans Agence") {
            return $this->influencerView();
        } else {
            //extract the id of the agency using a SQL query
            $agency = $this->extractColumnDB("SELECT id FROM agency WHERE name_agency='" . $agencyId . "'", 0);
            //use the agencyId to extract an Agency object
            $Agency = $this->getDoctrine()->getRepository(Agency::class)->find($agency[0]);

            return $this->render('influencerManagement/selectAgency.html.twig', ['Agency' => $Agency]);
        }
    }
    /**
     * @Route("InfluencerManagement/modif?agency={agencyId}", name="modifAgency")
     */
    //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    public function modifAgency($agencyId)
    {
        return $this->render('influencerManagement/modifAgency.html.twig');
    }
    //TODO check if this could be integrated into influencerView instead, as a "pop-up" or a subpage
    public function deleteAgency($idAgency)
    {
        return $this->render('influencerManagement/deleteAgency.html.twig');
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
        $stmt = $PDO->query($SQL)->fetchAll(PDO::FETCH_COLUMN, $numColumn);
        $PDO = null;
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
        $idAgency = $this->getDoctrine()->getRepository(User::class)->find($userid)->getidAgency();

        $Agency = $this->getDoctrine()->getRepository(Agency::class)->find($idAgency);
        if ($Agency == null) {
            $AgencyN = new Agency();
            return $AgencyN->setnameAgency("Sans Agence");
        } else {
            return $Agency;
        }
    }


    /**
     * Calcul the V30 of the stats object passed in parameter
     * @param $idStats: an idStat type object
     * @return $V30: The actual V30 based on the information of the idStat object
     * @return $updatedAt: return the date where the data was extracted from the social site (in order to keep track of updated data)
     * 
     * @error can throw a Not Found Exception if another stat from 30 days isn't found 
     */

    /** public function getV30( $idStats )
     * 
     {
         //TODO calcul V30 here
        $V30=0;
        $updatedAt=0;
        if ($idStats instanceof StatsYT){        
                $updatedAt= $idStats->getUpdatedAt();
                //FIXME fix cette requête pour bien ajouter 30j au time stamp de l'objet idStats passé en @param 
                //WARN besoin de faire une requête "classique" pour un WHERE LIKE sur le timestamp (Delta de 3 jours à confirmer avec @PJ)
                $idStatsOld->getDoctrine()->getRepository(StatsYT::class)->findOneBy(['updatedAt'=>$updatedAt+30j]);
                if (!($idStatsOld instanceof StatsYT)) {
                    throw $this->createNotFoundException(
                        'No stats found'
                    );
                return $V30=-1;
                return $updatedAt=-1;
                }
                $V30=($idStats->getViewYT() - $idStatsOld->getViewYT())/($idStats->getNbVid37YT()-$idStats->getNbVid7YT());
            } else{
                return $V30=-1;
                return $updatedAt=-1;
            }
        return $V30;
        return $updatedAt;
     }*/
}
