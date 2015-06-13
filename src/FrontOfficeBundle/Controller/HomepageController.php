<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction()
    {
    	$em = $this -> getDoctrine()->getManager();
    	$getInvitation = $em -> getREpository('FrontOfficeBundle:Invitation') -> getInvitation();

        return $this->render('FrontOfficeBundle:Homepage:homepage.html.twig', 
        	array('getInvitation' => $getInvitation));
    }
}
