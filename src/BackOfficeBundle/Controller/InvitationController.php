<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Invitation;
use FrontOfficeBundle\Entity\Sport;
use UserBundle\Entity\User;

class InvitationController extends Controller
{
	public function statsAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$getNbInvitsByUser = $em -> getRepository('UserBundle:User') ->getNbInvitsByUser();
		$getNbInvitsReceivedByUser = $em -> getRepository('UserBundle:User') ->getNbInvitsReceivedByUser();	

		return $this -> render('BackOfficeBundle:Invitation:stats.html.twig', 
			array('getNbInvitsByUser'        => $getNbInvitsByUser,
				  'getNbInvitsReceivedByUser'=>$getNbInvitsReceivedByUser));
	}
}