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
		$showTeams = $em -> getRepository('FrontOfficeBundle:Team')->getLastCreatedTeams();

		return $this -> render('FrontOfficeBundle:Team:showTeams.html.twig', 
			array('showTeams'=>$showTeams));
	}

	public function oneTeamAction($id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$oneTeam = $em -> getRepository('FrontOfficeBundle:Team')-> find($id);

		return $this -> render('FrontOfficeBundle:Team:one.html.twig',
		    array('oneTeam'=>$oneTeam));
	}
}
