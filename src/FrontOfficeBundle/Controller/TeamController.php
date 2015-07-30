<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Team;
use FrontOfficeBundle\Entity\Comment;
use FrontOfficeBundle\Form\TeamType;
use FrontOfficeBundle\Form\CommentType;
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

	public function oneTeamAction(Request $request,$id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$oneTeam = $em -> getRepository('FrontOfficeBundle:Team')-> find($id);		
		$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);

		$form -> handleRequest($request);

		if ($form -> isValid())
		{
			$comment -> setDateCreated(new \datetime());
			$comment -> setAuthor($this -> getUser());
			$comment -> setValidationAdmin(false);
			$comment -> setTeam($oneTeam);
			$em -> persist($comment);
			$em -> flush();		

			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this -> render('FrontOfficeBundle:Team:one.html.twig',
		    array('oneTeam'=> $oneTeam,
		    	  'form'   => $form -> createView()));
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
			$team -> setAdmin($this -> getUser());
			//$team -> addUser($this ->getUser());
			//La join_table est située du coté User, on appelle la team en se plaçant du coté de cette table. Le créateur fait automatiquement partie de la team.
			$this -> getUser() -> addTeam($team);

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

	public function userDeleteAction(Request $request, $idUser, $idTeam)
	{
		$em = $this -> getDoctrine()->getManager();
		$team = $em -> getRepository('FrontOfficeBundle:Team')->find($idTeam);
		$idUser = $team -> getUser($id);
		$em -> removeUser($idUser);
		$em -> flush();

		return $this -> redirect($request->headers->get('referer'));
	}

	public function teamDeleteAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$teamDelete = $em -> getRepository('FrontOfficeBundle:Team') ->find($id);
		$em -> remove($teamDelete);
		$em -> flush();

		return $this -> redirect($request->headers->get('referer'));
	}
}
