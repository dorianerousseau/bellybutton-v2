<?php

/**
 * Name: InfluencerManagementController.php
 * Author: Flavien Macquignon
 * Date: 05/10/2020
 * Comment: Ce fichier prend en charge toutes les fonctions de calcul de la partie InfluenceurManagement
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
{   //TODO Trouver comment sécuriser l'accès à ce controlleur, bloquer son accès pour les utilisateurs sans le bon rôle.
    //TODO Connecter ce controlleur aux runners pour une mise à jour des infos YT, IG, TW et TK


    // TODO Les paramètres de ce PDO doivent êtres changés, ils sont spécifiques au local
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
    //---------------------------------------------------------------------------------------------------------------------------------------
    //                                  Gestion des Influenceurs
    //---------------------------------------------------------------------------------------------------------------------------------------
    /**
     * Permet d'ajouter les informations d'un Influenceur à la base de donnée
     * @param $request
     * 
     * @return $this->render() Permet l'affichage du Formulaire AddInfluenceur au travers de la page templates\influencerManagement\add.html.twig
     * @return $this->redirectToRoute() Redirige l'utilsateur vers la page d'Ajout des informations de Vente
     * //TODO @return $this->redirectToRoute () Rediriger l'utilisateur vers la page selectInfluenceur (pour afficher les informations du nouvel utilisateur entré)
     */
    /**
     * @Route("InfluencerManagement/add", name="addInfluencer")
     */
    public function addInfluencer(Request $request)
    {
         //TODO Connecter ceci à la fonction success() de InflucencerController afin d'ajouter l'ID du nouvel influenceur à la table performance
         /*TODO Effectuer des vérifications afin de ne pas ajouter un Influenceurs dans le back si il est déjà inscrit sur la plateforme 
         * ==> effectuer une recherche (influenceurPrésent?) avant chaque ajout
         */
        //Préparation pour le menu "DropDown" permettant la sélection des agences
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
        //Formulaire AddInfluenceur comprenant les différents champs néceassaires à l'ajout d'un Influenceur
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
            //Un "dropdown menu" est affiché en utilisant les options du tableau $choiceAgency
            ->add('agencyId', ChoiceType::class, [
                'choices'  => $choiceAgency,
            ])
            //WARN Cette Partie n'est pas terminée
            //TODO La photo doit être sauvegardé dans "assets\images\Influencer" et son PATH doit être sauvegardé dans la base
            ->add('picture_small', FileType::class, [
                'required' => false,
            ])
            //TODO Même chose que pour picture_small
            ->add('picture_large', FileType::class, [
                'required' => false,
            ])
            //WARN Les différentes catégories d'audience ne sont pas stockées en "PlainText" mais grace à un numéro dont la correspondance ce fait ici
            /**
             * //TODO Vérifier avec PJ si il veut pouvoir "Override" les valeurs d'un Influenceur 
             * (Cette catégorie est déterminée de manière "automatique" en fonction des données des Stats), 
             * si un influenceur se retrouve entre 2 catégories, doit-on pouvoir la changer "automatiquement"?
             * La sélection ici intègre un 1 devant la catégorie; si elle est déterminée automatiquement, on ajoutera un zéro devant la catégorie.
             * Si jamais la catégorie déterminée "automatiquement", et celle ajoutée "à la main" sont identique, on modifiera la valeur avec un zéro devant
             * Si jamais la valeur a été enregistré depuis une nombre de jours spécifiés, et que l'influenceur n'a pas rejoins la catégorie spécifiée, on la modifiera avec une zéro devant
             *  //WARN vérifier avec PJ ce qui l'intéresse le plus pour cela
             */
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
                    //FIXME Permettre l'affichage d'un symbole "Checkmark dans la "Dropdown" List à la place de "Check"
                    "Check" => '5'
                ]
            ])
            //Représente les différents secteurs de BB
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
        //Test pour vérifier si le formulaire est bien renvoyé par l'utilisateur et si il a été correctement remplis
        if ($form->isSubmitted() && $form->isValid()) {
            //Récupère les données du formulaire dans la variable $add afin de disperser les données dans la Base
            $add = $form->getData();
            //Ce tableau est utilisé pour générer un formulaire afin de rentrer les informations des tables de vente; il est initialisé à false par défaut
            $URL = array(
                'URLYT' => "false",
                'URLIG' => "false",
                'URLTW' => "false",
                'URLTK' => "false",
                'userId' => "1"
            );
            //Vérifie si les différents champs contenant les URL des réseaux ont été remplis, si oui, initialise le tableau URL à "true"
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

            //Répartir les données de $add entre les différents Entity
            //TODO Effectivement ajouter les influenceurs à la Base de Données en utilisant Doctrine

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            //Redirige vers le formulaire d'ajout des informations de vente
            /*TODO Ajouter un test pour prendre en compte le fait de ne pas avoir rempli les différentes URL 
            * et donc d'ajouter un Influenceur sans ces informations de vente
            * Il faudra également penser à redigérer l'utilisateur vers la page selectInfluenceur 
            * du nouvel utilisateur même si ce dernier n'a pas d'information de vente
            */
            return $this->redirectToRoute('AddVente', $URL);
        }

        return $this->render('influencerManagement/add.html.twig', [
            'Form' => $form->createView()
        ]);
    }
    
/**
     * Permet d'ajouter les informations d'un de vente d'un Influenceur à la base de donnée
     * @param $request
     * @param string $URLYT Détermine si le Champs URLYT était remplis ou non sur le formulaire de addInlfluenceur ('true' ou 'false')
     * @param string $URLTW Détermine si le Champs URLTW était remplis ou non sur le formulaire de addInlfluenceur ('true' ou 'false')
     * @param string $URLTK Détermine si le Champs URLTK était remplis ou non sur le formulaire de addInlfluenceur ('true' ou 'false')
     * @param string $URLIG Détermine si le Champs URLIG était remplis ou non sur le formulaire de addInlfluenceur ('true' ou 'false')
     * @param integer $userId L'userID de l'Influenceur concerné par les informations de vente entré sur cette page
     * 
     * @return $this->redirectToRoute() Rediriger l'utilisateur vers la page selectInfluenceur (pour afficher les informations du nouvel utilisateur entré)
     * @return $this->render() Permet l'affichage du Formulaire addVente au travers de la page templates\influencerManagement\addVente.html.twig
     */
    /**
     * @Route("InfluenceurManagement/addVente?user={URLYT}_{URLTW}_{URLTK}_{URLIG}_{userId}", name="AddVente")
     */
    public function addVente(Request $request, $URLYT, $URLTW, $URLTK, $URLIG, $userId)
    {
        //Formulaire similaire à l'ajout d'un influenceur mais comprenant uniquement les informations de vente
        $addVente = new AddVente();
        $form = $this->createFormBuilder($addVente);

        //Différents test afin de n'ajouter que les informations concernant les URL ayant été effectivement remplies sur le formulaires précédent ($URL passe les données entre les pages)
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
        //Partie d'ajout effective des données 
        if ($form->isSubmitted() && $form->isValid()) {
            //WARN l'ajout des données n'a pas pu être testé
            $addVente = $form->getData();
            //Test si le champs URL avait été remplis
            if ($URLYT == "true") {
                //Disperse les informations de $addVente vers une nouvelle Entity ($venteYT); c'est cette Entity qui sera enregistrée par Doctrine
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
            //Recupère l'EntityManager de l'Entity VenteYT
            $venteYTEM = $this->getDoctrine()->getManager();
            //Prépare Doctrine à sauvegarder l'Entity dans la base de données
            $venteYTEM->persist($venteYT);
            //Sauvegarde l'Entity dans la base de données
            $venteYTEM->flush();
            }
            //Repète l'opération avec IG
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
            //TODO Effectuer les ajouts vers la base pour TW et TK

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
     * Permet d'afficher la liste de tous les influenceurs présents dans la base
     * @return $this->render() Permet l'affichage d'une liste des influenceurs au travers de la page templates\influencerManagement\select.html.twig
     */
    /**
     * @Route("InfluenceurManagement/influenceurView", name="influencerView")
     */
    public function influencerView()
    {
        //Recupère le nombre d'utilisateur Influenceur pour remplir $k et alimenter la boucle do...While
        $k = $this->extractColumnDB("SELECT COUNT(user_id) FROM user_role WHERE role_id=3", 0);

        //Retourne un tableau contenant tous les user_id dont le role==3
        //Retourne tous les id des utilisateurs qui sont effectivement des Influenceurs
        $stmt = $this->extractColumnDB("SELECT user_id FROM user_role WHERE role_id='3'", 0);

        // Initialisation des variables pour la boucle
        $i = $k[0] - 1;
        $j = 0;

        //Boucle pour extraire chaque utilisateur en fonction de leur id
        do {
            //Extraction des informations depuis Doctrine afin de remplir le Template
            //$stmt contient les id et $j est une clé qui augmente de 1 à chaque boucle (afin de passer à l'id suivant)
            $users[] = $this->getDoctrine()->getRepository(User::class)->find(($stmt[$j]));
            //Extrait les Agence de chaque utilisateur (getAgency renvoit une Entity Agency)
            $Agency[] = $this->getAgency($stmt[$j]);
            $i--;
            $j++;
        } while ($i >= 0);

        return $this->render('influencerManagement/index.html.twig', [
            'users' => $users,
            'Agency' => $Agency
        ]);
    }

    /**
     * Permet de supprimmer un Influenceur de la base de données
     * //TODO @param $userID Id de l'utilisateur à supprimer de la base de donnée
     * @return $this->render() Permet d'afficher la page de confirmation de suppression //TODO Créer la page de suppression
     */
    //TODO Vérifier si cette page ne peut pas être intégré dans une page selectInfluenceur (comme une IFrame par exemple et donc limiter le nombre de changement de page)
    /**
     * @Route("InfluencerManagement/delete", name="deleteInfluencer")
     */
    public function removeInfluencer()
    {
        return $this->render('influencerManagement/remove.html.twig');
    }

    /**
     * Permet de modifier les informations d'un Influenceur de la base de donnée
     * //TODO @param $userID Id de l'utilisateur concerné par la modification
     * @return $this->render() Permet d'afficher le formulaire permettant la modification (le Formulaire doit être prérempli avec les informations présentes dans la base) //TODO Créer la page de modification 
     */
    //TODO Vérifier si cette page ne peut pas être intégré dans une page selectInfluenceur (comme une IFrame par exemple et donc limiter le nombre de changement de page)
    /**
     * @Route("InfluencerManagement/modif", name="modifInfluencer")
     */
    public function modifInfluencer()
    {
        return $this->render('influencerManagement/modif.html.twig');
    }
    /**
     * Permet d'effectuer une recherche au sein de la base de donnée
     * 
     */
    //TODO Créer cette fonction de recherche d'un influenceur
    public function searchInfluencer()
    {
    }

    //TODO Envoyer un Uitlisateur, une Agence, une Performance, les Stats, une table catAudience (par Stats) et des Vente (Quand elles sont présentes)
    //TODO Extraire ces objets sur une base "historique" --> N'extraire que les plus "récents" afin d'effectuer les calculs sur de données "à jour" (V30 en particulier)
    //TODO Trouver un moyen de gérer l'historique 
    /**
     * @Route("InfluencerManagement/select?user={userId}", name="selectInfluencer")
     */
    public function selectInfluencer(int $userId)
    {
        //TODO Faire attention à la correspondance entre les différentes catégories d'Audience (Ne PAS afficher le numéro stocker dans la base de données mais plutôt son équivalent (voir formulaire AddInfluenceur))
        // WARN Attention au correspondance également pour 'Status' et 'Sector'
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);
        return $this->render('influencerManagement/select.html.twig', ['user' => $user]);
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    //                              Gestion des Agences
    //---------------------------------------------------------------------------------------------------------------------------------
    //TODO Vérifier si cette page ne peut pas être intégré dans une page (comme une IFrame par exemple et donc limiter le nombre de changement de page)
    //TODO Gérer ici l'ajout d'une agence
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
            //Extrait l'id de l'agence en se basant sur $agencyid
            $agency = $this->extractColumnDB("SELECT id FROM agency WHERE name_agency='" . $agencyId . "'", 0);
            //Extrait l'objet Agency en utilisant l'id $agency
            $Agency = $this->getDoctrine()->getRepository(Agency::class)->find($agency[0]);

            return $this->render('influencerManagement/selectAgency.html.twig', ['Agency' => $Agency]);
        }
    }
    /**
     * @Route("InfluencerManagement/modif?agency={agencyId}", name="modifAgency")
     */
    //TODO Vérifier si cette page ne peut pas être intégré dans une page (comme une IFrame par exemple et donc limiter le nombre de changement de page)
    public function modifAgency($agencyId)
    {
        return $this->render('influencerManagement/modifAgency.html.twig');
    }
//TODO Vérifier si cette page ne peut pas être intégré dans une page (comme une IFrame par exemple et donc limiter le nombre de changement de page)
    public function deleteAgency($idAgency)
    {
        return $this->render('influencerManagement/deleteAgency.html.twig');
    }
    //---------------------------------------------------------------------------------------------------------------------------------
    //                              Fonctions
    //---------------------------------------------------------------------------------------------------------------------------------
    /**
     * Envoit une requête à la base de donnée et extrait une unique colonne 
     * @param $SQL: La requête SQL
     * @param $numColumn: Permet de sélectionner le numéro de colonne à retourner (commence à zéro)
     *
     * @return $stmt: Un tableau de toutes les lignes de la colonne spécifié par $numColumn
     */
    private function extractColumnDB(string $SQL, int $numColumn)
    {
        $PDO = new PDO(self::dsn, self::user, self::pass, self::options);
        $stmt = $PDO->query($SQL)->fetchAll(PDO::FETCH_COLUMN, $numColumn);
        $PDO = null;
        return $stmt;
    }

    /**
     * Récupère l'object Agency de l'userid passé en paramètre
     * @param $userid: L'userid dont vous voulez retrouver l'Agence
     * @return $AgencyN: Si la requête retourne "null" renvoit un objet Agency sans id et dont le nom est :"Sans Agence"
     * @return $Agency: Si une Agence est retrouvé par la requête, renvoit un objet Agency remplis par les informations concernant l'Agence
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
     * Calcule la V30 de l'Objet passé en Paramètre
     * @param $idStats: Un objet de type IdStats
     * @return $V30: LA valeur de la V30 une fois calculé
     * @return $updatedAt: Retourne la date de la dernière mise à jour des données depuis le réseau social afin de fournir une indication de "l'age des données"
     * 
     * @error Peut renvoyer une erreur 'No stats Found' si aucune donnée ne permet le calcul 
     */

    /** public function getV30( $idStats )
     * 
     {
         //TODO Calculer la V30 ici (Vérifier le calcul)
        $V30=0;
        $updatedAt=0;
        if ($idStats instanceof StatsYT){        
                $updatedAt= $idStats->getUpdatedAt();
                //FIXME Ajouter 30jours à l'objet idStats passé en @param 
                //WARN Il faut faire une requête "classique" pour un WHERE LIKE sur le timestamp (Delta de 3 jours à confirmer avec @PJ)
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
