<?php

/**
 * Name: InfluencerManagementController.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: This file handle all the compute function of the influencer management dashboard of Bellybutton Group
 */

namespace App\Controller;

use App\Entity\InfluenceurManagement\AddInfluencer;
use App\Entity\InfluenceurManagement\AddVente;
use App\Entity\User;
use App\Entity\InfluenceurManagement\Agency;
use App\Entity\InfluenceurManagement\VenteIG;
use App\Entity\InfluenceurManagement\VenteTK;
use App\Entity\InfluenceurManagement\VenteTW;
use App\Entity\InfluenceurManagement\VenteYT;
use App\Entity\StatsIG;
use App\Entity\StatsTK;
use App\Entity\StatsTW;
use App\Entity\StatsYT;
use PDO;
use Symfony\Component\Form\FormInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InfluencerManagementController extends AbstractController
{   //TODO figure out a way to secure the acess to this controler==> Maybe link it the same way as Dashboard
    //TODO figure out the service runner for TK; IG and TW (YT seems implemented) ==> Maybe implement a meta-runner?


    // TODO insert special user to the DB here; must be one with read and write access to the DB
    //Constantes pour une connection via PDO
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
        //-----------------------------------------------
        // Preparation to handle a drop down menu on all Agency of the Database
        // Compteur pour arrêter la boucle
        $k = 0;
        //Nombre d'agence dans la Base, détermine la longueur de la boucle
        $nbrAgences = $this->extractColumnDB('SELECT COUNT(id) FROM agency', 0);
        //Extrait les id des Agences
        $Agencyid = $this->extractColumnDB('SELECT id FROM agency', 0);
        //Extrait les noms des agences
        $AgencyName = $this->extractColumnDB('SELECT name_agency FROM agency', 0);
        //Ajoute le choix "Sans Agence" car il n'est pas présent dans la Base
        $choiceAgency = ['Sans Agence' => null];
        //Boucle pour remplir le tableau $choiceArray avec une association 'id'=>'name_agency'
        do {
            $tempArray = [$AgencyName[$k] => $Agencyid[$k]];
            $choiceAgency = array_merge($choiceAgency, $tempArray);
            $k++;
        } while ($k < $nbrAgences[0]);
        //---------------------------------------------------------
        //Actual form as displayed on the Page
        $add = new AddInfluencer();
        $form = $this->createFormBuilder($add)
            ->add('fname', TextType::class)
            ->add('lname', TextType::class)
            ->add('mailpro', TextType::class)
            ->add('URLYT', TextType::class, [
                'required' => false,
            ])
            ->add('URLIG', TextType::class, [
                'required' => false,
            ])
            ->add('URLTW', TextType::class, [
                'required' => false,
            ])
            ->add('URLTK', TextType::class, [
                'required' => false,
            ])
            ->add('agencyId', ChoiceType::class, [
                'choices'  => $choiceAgency,
            ])
            //WARN check if this is handled correctly
            ->add('picture_small', FileType::class, [
                'required' => false,
            ])
            ->add('picture_large', FileType::class, [
                'required' => false,
            ])
            ->add('catAudience', ChoiceType::class, [
                'choices' =>
                [
                    'Aucune' => "10",
                    'G (0 - 50K)' => "11",
                    'F (50 - 150K)' => "12",
                    'E (150 - 200K)' => '13',
                    'D (250 - 350K)' => '14',
                    'C (350 - 500K)' => '15',
                    'B (500K - 1M)' => '16',
                    'A (1M > )' => '17'
                ]
            ])

            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Aucun' => null,
                    'To Qualify' => '1',
                    'Qualified' => '2',
                    'Open' => '3',
                    'OK' => '4',
                    //FIXME display check mark here
                    "Check" => '5'
                ]
            ])
            ->add('Sector', ChoiceType::class, [
                'choices' =>
                [
                    'Auto' => '0',
                    'Agriculture' => '1',
                    'ASMR' => '2',
                    'Art' => '3',
                    'Beauté' => '4',
                    'Cinéma' => '5',
                    'Divertissement' => '6',
                    'Deco' => '7',
                    'Développement' => '8',
                    'Espace' => '9',
                    'Famille' => '10',
                    'Food' => '11',
                    'Foot' => '12',
                    'Gaming' => '13',
                    'Histoire' => '14',
                    'Home' => '15',
                    'Humour' => '16',
                    'Lifestyle' => '17',
                    'Manga' => '18',
                    'Musique' => '19',
                    'Mode' => '20',
                    'Pêche' => '21',
                    'Sport' => '22',
                    'Science' => '23',
                    'Tech' => '24',
                    'Voyage' => '25'

                ]
            ])
            ->add('Description', TextType::class)
            ->add('Commentary', TextType::class, [
                'required' => false,
            ])
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $add = $form->getData();
            //Ce tableau doit être utilisé pour générer un formulaire afin de rentrer les informations des tables de vente
            $URL = array(
                'URLYT' => "false",
                'URLIG' => "false",
                'URLTW' => "false",
                'URLTK' => "false",
                'userId' => "1"
            );
            if ($add->getURLYT() != null) {
                $URL['URLYT'] = "true";
            }
            if ($add->getURLIG() != null) {
                $URL['URLIG'] = "true";
            }
            if ($add->getURLTW() != null) {
                $URL['URLTW'] = "true";
            }
            if ($add->getURLTK() != null) {
                $URL['URLTK'] = "true";
            }




            //WARN this is for testing purposes
            $userId = 1;
            //TODO add the influencer to the DB and add a redirect to SelectInfluencer with the specified userID
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            //TODO redirect here to a vente form 
            //this task_success must account for a full false $URL array
            return $this->redirectToRoute('AddVente', $URL);
        }

        return $this->render('influencerManagement/add.html.twig', [
            'Form' => $form->createView()
        ]);
    }
    // TODO figure out how to print only 10 influencer at a time ==> Maybe by making this an extends of another page and reload only this part (aka the tab)

    /**
     * @Route("InfluenceurManagement/addVente?user={URLYT}_{URLTW}_{URLTK}_{URLIG}_{userId}", name="AddVente")
     */
    public function addVente(Request $request, $URLYT, $URLTW, $URLTK, $URLIG, $userId)
    {
        $addVente = new AddVente();
        $form = $this->createFormBuilder($addVente);

        if ($URLYT == "true") {

            $form
                ->add('GarantieYT', IntegerType::class)
                ->add('EstimationYT', IntegerType::class)
                ->add('CachetInteYT', IntegerType::class)
                ->add('MargeInteYT', IntegerType::class)
                ->add('CachetVidDeYT', IntegerType::class)
                ->add('MargeVidDeYT', IntegerType::class);
        }
        if ($URLIG == "true") {
            $form
                ->add('CachetPostIG', IntegerType::class)
                ->add('MargePostIG', IntegerType::class)
                ->add('CachetStoryIG', IntegerType::class)
                ->add('MargeStoryIG', IntegerType::class)
                ->add('CachetIGTV', IntegerType::class)
                ->add('MargeIGTV', IntegerType::class);
        }
        if ($URLTW == "true") {
            $form
                ->add('CachetPDPTW', IntegerType::class)
                ->add('MargePDPTW', IntegerType::class)
                ->add('CachetSponsoTW', IntegerType::class)
                ->add('MargeSponsoTW', IntegerType::class);
        }
        if ($URLTK == "true") {
            $form
                ->add('CachetPostTK', IntegerType::class)
                ->add('MargePostTK', IntegerType::class);
        }
        $form = $form
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $addVente = $form->getData();
            
            if ($URLYT == "true") {
                $venteYT= new VenteYT;
                if ($addVente->getGarantieYT() != null) {
                    $venteYT->setGarantie($addVente->getGarantieYT());
                }
                if($addVente->getEstimationYT()!=null){
                    $venteYT->setEstimation($addVente->getEstimationYT());
                }
                if($addVente->getCachetInteYT()!=null)
                {
                    $venteYT->setCachetInte($addVente->getCachetInteYT());
                }
                if($addVente->getMargeInteYT()!=null)
                {
                    $venteYT->setMargeInte($addVente->getMargeInteYT());
                }
                else{
                    $venteYT->setMargeInte(25);
                }

                if($addVente->getCachetVidDeYT()!=null)
                {
                    $venteYT->setCachetVidDe($addVente->getMargeVidDe());
                }
                if ($addVente->getMargeVidDe()!=null)
                {
                    $venteYT->setCachetVidDe($addVente->getMargeVidDe());
                }
                else{
                    $venteYT->setCachetVidDe(25);
                }
            $venteYTEM = $this->getDoctrine()->getManager();
            $venteYTEM->persist($venteYT);
            $venteYTEM->flush();
            }
            if($URLIG == "true") {
                $venteIG = new VenteIG;
                if($addVente->getCachetPostIG()!=null)
                {
                    $venteIG->setCachetPost($addVente->getCachetPostIG());
                }
                if($addVente->getMargePostIG()!=null)
                {
                    $venteIG->setMargePost($addVente->getMargePostIG());
                }
                else{
                    $venteIG->setMargePost(25);
                }
                if($addVente->getCachetStoryIG()!=null)
                {
                    $venteIG->setCachetStory($addVente->getCachetStoryIG());
                }
                if($addVente->getMargeStoryIG()!=null)
                {
                    $venteIG->setMargeStory($addVente->getMargeStoryIG());
                }
                else{
                    $venteIG->setMargeStory(25);
                }
                if($addVente->getCachetIGTV()!=null)
                {
                    $venteIG->setCachetIGTV($addVente->getCachetIGTV());
                }
                if($addVente->getMargeIGTV()!=null)
                {
                    $venteIG->setMargeIGTV($addVente->getMargeIGTV());
                }
                else{
                    $venteIG->setMargeIGTV(25);
                }
            $venteIGEM = $this->getDoctrine()->getManager();
            $venteIGEM->persist($venteIG);
            $venteIGEM->flush();
            }
            // $venteYTEM =$this->getDoctrine()->getManager();
            //$venteYTEM->persist();
            //$venteYTEM->flush();}
            return $this->redirectToRoute('selectInfluencer', $userId);
        }
        return $this->render('influencerManagement/addVente.html.twig', [
            'Form' => $form->createView(),
            'YT' => $URLYT,
            'IG' => $URLIG,
            'TW' => $URLTW,
            'TK' => $URLTK
        ]);
    }
    /**
     * @Route("InfluenceurManagement/influenceurView", name="influencerView")
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
            //here extract info from Doctrine to populate the template; $stmt holds all the id; $j act as a key that move by ++ each loop
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
    /**
     * @Route("InfluencerManagement/addAgency", name="addAgency")
     */
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
