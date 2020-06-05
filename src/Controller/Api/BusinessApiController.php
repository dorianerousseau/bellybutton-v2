<?php

namespace App\Controller\Api;

use App\Repository\CampaignRepository;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api", name="api")
 */
class BusinessApiController extends AbstractController
{
    /**
     * @Route("/campaign/{id<\d+>}", name="_campaign", methods={"GET"})
     */
    public function list(UserRepository $userRepository, RoleRepository $roleRepository,CampaignRepository $campaignRepository, $id, Request $request)
    { 
      // Je récupère le role "business"  
      $roleBusiness= $roleRepository->findOneBy(['name' => 'ROLE_BUSINESS']);
      // je récupère l'utilisateur qui as le role business et l'id de l'utilisateur que l'api va requeter 
      $business = $userRepository->getUserByRole($roleBusiness, $id);
      // Récuperation des campagnes liée à l'utilisateur $business
      $campaign = $campaignRepository->getCampaignByBusiness($business);
      dd($campaign);
      // TODO Serializer les données
    }
}