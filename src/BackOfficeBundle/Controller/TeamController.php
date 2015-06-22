<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Team;
use FrontOfficeBundle\Form\TeamType;

class TeamController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$team = $em -> getRepository('FrontOfficeBundle:Team') -> getTeamUnvalidated();

		return $this -> render('BackOfficeBundle:Team:list.html.twig', 
			array('team'=> $team));
	}
}