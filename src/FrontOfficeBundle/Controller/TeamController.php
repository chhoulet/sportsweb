<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Team;
use FrontOfficeBundle\Form\TeamType;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
	public function showTeamsAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$showTeams = $em -> getRepository('FrontOfficeBundle:Team')->findAll();

		return $this -> render('FrontOfficeBundle:Team:showTeams.html.twig', 
			array('showTeams'=>$showTeams));
	}
}
