<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction()
    {
        /* Statistiques du BO*/
    	$em = $this -> getDoctrine() ->getManager();
    	$invitations           = $em -> getRepository('FrontOfficeBundle:Invitation') -> nbInvitations();
    	$nbInvitationsAccepted = $em -> getRepository('FrontOfficeBundle:Invitation') -> nbInvitationsAccepted();
    	$nbInvitationsDenied   = $em -> getRepository('FrontOfficeBundle:Invitation') -> nbInvitationsDenied();
        $nbUsers               = $em -> getRepository('UserBundle:User') -> nbUsers();
        $nbComments            = $em -> getRepository('FrontOfficeBundle:Comment') -> nbComments();
        $nbArticles            = $em -> getRepository('FrontOfficeBundle:Article') -> nbArticles();
        $nbMessages            = $em -> getRepository('FrontOfficeBundle:Message') -> nbMessages();
        $nbTeams               = $em -> getRepository('FrontOfficeBundle:Team') -> nbTeams();
        $getSportsByInvitsNumber=$em -> getRepository('FrontOfficeBundle:Sport') -> getSportsByInvitsNumber();
 
        return $this -> render('BackOfficeBundle:Homepage:homepage.html.twig', 
        	array('invitations'          => $invitations,
        		  'nbInvitationsAccepted'=> $nbInvitationsAccepted,
        		  'nbInvitationsDenied'  => $nbInvitationsDenied,
                  'nbUsers'              => $nbUsers,
                  'nbComments'           => $nbComments,
                  'nbArticles'           => $nbArticles,
                  'nbMessages'           => $nbMessages,
                  'nbTeams'              => $nbTeams,
                  'getSportsByInvitsNumber'=> $getSportsByInvitsNumber));
    }
}
