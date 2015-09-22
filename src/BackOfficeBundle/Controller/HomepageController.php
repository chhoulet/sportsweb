<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction()
    {
        /* Statistiques du BO*/
    	$em = $this -> getDoctrine() ->getManager();
    	$invitations             = $em -> getRepository('FrontOfficeBundle:Invitation') -> nbInvitations();
    	
    	$nbGrounds               = $em -> getRepository('FrontOfficeBundle:Ground')     -> nbGrounds();
      $nbUsers                 = $em -> getRepository('UserBundle:User')              -> nbUsers();
      $nbComments              = $em -> getRepository('FrontOfficeBundle:Comment')    -> nbComments();
      $nbArticles              = $em -> getRepository('FrontOfficeBundle:Article')    -> nbArticles();
      $nbMessages              = $em -> getRepository('FrontOfficeBundle:Message')    -> nbMessages();
      $nbTeams                 = $em -> getRepository('FrontOfficeBundle:Team')       -> nbTeams();
      $getSportsByInvitsNumber = $em -> getRepository('FrontOfficeBundle:Sport')      -> getSportsByInvitsNumber();
      $nbTournaments           = $em -> getRepository('FrontOfficeBundle:Tournament') -> nbTournaments();

        return $this -> render('BackOfficeBundle:Homepage:homepage.html.twig', 
        	array('invitations'             => $invitations,        		    
        		    'nbGrounds'               => $nbGrounds,
                'nbUsers'                 => $nbUsers,
                'nbComments'              => $nbComments,
                'nbArticles'              => $nbArticles,
                'nbMessages'              => $nbMessages,
                'nbTeams'                 => $nbTeams,
                'getSportsByInvitsNumber' => $getSportsByInvitsNumber,
                'nbTournaments'           => $nbTournaments));
    }
}
