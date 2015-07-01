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

	public function newAction(Request $request)
	{
		$em = $this -> getDoctrine()->getmanager();
		$team = new Team();
		$form = $this -> createForm(new TeamType(), $team);

		$form -> handleRequest($request);

		if ($form -> isValid())
		{
			$team -> setDateCreated(new \datetime('now'));
			$team -> setValidationAdmin(false);
			$team ->setUser($this ->getUser());
			$em -> persist($team);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_team_show'));
		}

		return $this -> render('FrontOfficeBundle:Team:new.html.twig', 
			array('form' => $form->createView()));
	}

	public function addUserAction($id)
	{
		$em = $this -> getDoctrine()->getmanager();
		$team = $em -> getRepository('FrontOfficeBundle:Team')->find($id);
		$team -> setUser($this -> getUser());
		$em -> persist($team);
		$em -> flush();

		return $this ->redirect($this -> generateurl('front_office_team_show'));
		/*return $this -> redirect($this->getUser()->get('urlFrom'));*/
	}
}
