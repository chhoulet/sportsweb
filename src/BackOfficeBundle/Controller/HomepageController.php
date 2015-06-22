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
 
        return $this -> render('BackOfficeBundle:Homepage:homepage.html.twig', 
        	array('invitations'          => $invitations,
        		  'nbInvitationsAccepted'=> $nbInvitationsAccepted,
        		  'nbInvitationsDenied'  => $nbInvitationsDenied,
                  'nbUsers'              => $nbUsers,
                  'nbComments'           => $nbComments));
    }
}
