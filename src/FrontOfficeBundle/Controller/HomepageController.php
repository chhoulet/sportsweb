<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction()
    {
    	$em          = $this -> getDoctrine()->getManager();
    	# Appel des functions triant les invitations par sport :
        $invitForConnectedUser = $em -> getRepository('FrontOfficeBundle:Invitation') -> seeInvitationsForOneUser($this -> getUser());
    	$allInvit = $em -> getRepository('FrontOfficeBundle:Invitation') -> findAll();
    	

        return $this->render('FrontOfficeBundle:Homepage:homepage.html.twig', 
        	array('invitForConnectedUser' => $invitForConnectedUser,
        		  'allInvit'              => $allInvit));
    }
}
