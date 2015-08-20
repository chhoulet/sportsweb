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
		$session = $request -> getSession();
		$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);

		$form -> handleRequest($request);

		if ($form -> isValid())
		{
			/*Attribution de valeur automatique d'attributs de l'objet Comment*/
			$comment -> setDateCreated(new \datetime());
			$comment -> setAuthor($this -> getUser());
			$comment -> setValidationAdmin(false);
			$comment -> setTeam($oneTeam);
			$em -> persist($comment);
			$em -> flush();

			/*Mise en place du message flash*/
			$session -> getFlashbag() -> add('notice','Merci de votre commentaire !');

			/*Redirection sur la même page*/
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

	/*Ajout d'un user dans une team*/
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

	public function triBySportAction($sportPracticed)
	{
		$em = $this -> getDoctrine()-> getManager();
		$triBySport = $em -> getRepository('FrontOfficeBundle:Team') -> getTeamsBySport($sportPracticed);

		return $this -> render('FrontOfficeBundle:Team:listTeams.html.twig', 
			array('listTeams'=> $triBySport));
	}

	public function getTeamsByGroundAndSportAction($ground, $sportPracticed)
	{
		$em = $this -> getDoctrine()-> getManager();
		$TeamsByGroundAndSport = $em ->getRepository('FrontOfficeBundle:Team')->getTeamsByGroundAndSport($ground, $sportPracticed);
	
		return $this -> render('FrontOfficeBundle:Team:listTeams.html.twig', 
			array('listTeams'=>$TeamsByGroundAndSport));
	}

}
