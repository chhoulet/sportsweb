<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction()
    {
    	$em          = $this -> getDoctrine()->getManager();
    	# Appel des functions triant les invitations par sport :
    	$invitFoot   = $em -> getRepository('FrontOfficeBundle:Invitation') -> sportInvitation('football');
    	$invitBasket = $em -> getRepository('FrontOfficeBundle:Invitation') -> sportInvitation('basketball');

        return $this->render('FrontOfficeBundle:Homepage:homepage.html.twig', 
        	array('invitFoot'   => $invitFoot,
        		  'invitBasket' => $invitBasket));
    }
}
