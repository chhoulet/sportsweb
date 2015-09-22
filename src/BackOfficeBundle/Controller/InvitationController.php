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
		$nbInvitationsAccepted   = $em -> getRepository('FrontOfficeBundle:Invitation') -> nbInvitationsAccepted();
		$getNbInvitsByUser         = $em -> getRepository('UserBundle:User') ->getNbInvitsByUser();
		$getNbInvitsReceivedByUser = $em -> getRepository('UserBundle:User') ->getNbInvitsReceivedByUser();
		$getNbInvitsBySport        = $em -> getRepository('FrontOfficeBundle:Sport') ->getNbInvitsBySport();
		$getNbInvitsByRegions      = $em -> getRepository('FrontOfficeBundle:Invitation') ->getNbInvitsByRegions();

		return $this -> render('BackOfficeBundle:Invitation:stats.html.twig', 
			array('nbInvitationsAccepted'    => $nbInvitationsAccepted,
				  'getNbInvitsByUser'        => $getNbInvitsByUser,
				  'getNbInvitsReceivedByUser'=> $getNbInvitsReceivedByUser,
				  'getNbInvitsBySport'       => $getNbInvitsBySport,
				  'getNbInvitsByRegions'     => $getNbInvitsByRegions));
	}
}