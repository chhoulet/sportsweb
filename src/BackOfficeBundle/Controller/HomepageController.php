<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction()
    {
    	$em = $this -> getDoctrine() ->getManager();
    	$invitations           = $em -> getRepository('FrontOfficeBundle:Invitation') -> nbInvitations();
    	$nbInvitationsAccepted = $em -> getRepository('FrontOfficeBundle:Invitation') -> nbInvitationsAccepted();
    	$nbInvitationsDenied   = $em -> getRepository('FrontOfficeBundle:Invitation') -> nbInvitationsDenied();
        $nbUsers               = $em -> getRepository('UserBundle:User') -> nbUsers();
 
        return $this -> render('BackOfficeBundle:Homepage:homepage.html.twig', 
        	array('invitations'          => $invitations,
        		  'nbInvitationsAccepted'=> $nbInvitationsAccepted,
        		  'nbInvitationsDenied'  => $nbInvitationsDenied,
                  'nbUsers'              => $nbUsers));
    }
}
