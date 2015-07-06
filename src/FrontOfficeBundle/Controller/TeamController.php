<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Team;
use FrontOfficeBundle\Form\TeamType;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
	public function listTeamsAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$listTeams = $em -> getRepository('FrontOfficeBundle:Team')->getLastCreatedTeams();

		return $this -> render('FrontOfficeBundle:Team:listTeams.html.twig', 
			array('listTeams'=>$listTeams));
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

			return $this -> redirect($this -> generateUrl('front_office_team_list'));
		}

		return $this -> render('FrontOfficeBundle:Team:new.html.twig', 
			array('form' => $form->createView()));
	}

	public function addUserAction(Request $request,$id)
	{
		$em = $this -> getDoctrine()->getmanager();
		$team = $em -> getRepository('FrontOfficeBundle:Team')->find($id);
		$team -> setUser($this -> getUser());
		$em -> persist($team);
		$em -> flush();

		return $this -> redirect($request->headers->get('referer'));
		
	}

	public function userDeleteAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$team = $em -> getRepository('FrontOfficeBundle:Team')->find($id);
		$userDelete = $team -> getUser($this -> getUser());
		$em -> remove($userDelete);
		$em -> flush();

		return $this -> redirect($request->headers->get('referer'));
	}
}
