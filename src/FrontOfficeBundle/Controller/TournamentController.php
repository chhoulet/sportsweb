<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Tournament;
use FrontOfficeBundle\Entity\Comment;
use FrontOfficeBundle\Form\TournamentType;
use FrontOfficeBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;

class TournamentController extends Controller
{
	public function newTournamentAction(Request $request)
	{
		$em = $this -> getDoctrine()->getmanager();
		$session = $request -> getSession();		
		$tournament = new Tournament();
		$postCode = $tournament -> getPostCode();
		$form = $this -> createForm(new TournamentType(), $tournament);

		$form -> handleRequest($request);

		if ($form -> isValid())
		{			
			if ($postCode == 75 || $postCode == 78 || $postCode == 91 || $postCode == 92 || $postCode == 93 || $postCode == 95)
			{
				$tournament -> setRegion('Ile-de-France');
			}

			if($postCode == 16 || $postCode == 17 || $postCode == 87 || $postCode == 23 || $postCode == 63 || $postCode == 15
				|| $postCode == 12 || $postCode == 81 || $postCode == 31 || $postCode == 32 || $postCode == 65 || $postCode == 64
				|| $postCode == 40 || $postCode == 47 || $postCode == 33 || $postCode == 24 || $postCode == 19 || $postCode == 46 
				|| $postCode == 82 || $postCode == 29)
			{
				$tournament -> setRegion('Sud-Ouest');
			}

			if($postCode == 09 || $postCode == 66 || $postCode == 11 || $postCode == 34 || $postCode == 48 || $postCode == 30
				|| $postCode == 07 || $postCode == 43 || $postCode == 42 || $postCode == 69 || $postCode == 01 || $postCode == 74
				|| $postCode == 73 || $postCode == 38 || $postCode == 26 || $postCode == 05 || $postCode == 13 || $postCode == 63
				|| $postCode == 84 || $postCode == 04 || $postCode == 83 || $postCode == 06 || $postCode == 20)
			{
				$tournament -> setRegion('Sud-Est');
			}

			if($postCode == 03 || $postCode == 71 || $postCode == 39 || $postCode == 25 || $postCode == 70 || $postCode == 58
				|| $postCode == 21 || $postCode == 68 || $postCode == 89 || $postCode == 10 || $postCode == 52 || $postCode == 88
				|| $postCode == 10 || $postCode == 52 || $postCode == 54 || $postCode == 67 || $postCode == 55 || $postCode == 57)
			{
				$tournament -> setRegion('Est');
			}

			if($postCode == 59 || $postCode == 51 || $postCode == 08 || $postCode == 02 || $postCode == 60 || $postCode == 80
				|| $postCode == 62 || $postCode == 76)
			{
				$tournament -> setRegion('Nord');
			}

			if($postCode == 27 || $postCode == 14 || $postCode == 50 || $postCode == 61 || $postCode == 28 || $postCode == 45
				|| $postCode == 18 || $postCode == 41 || $postCode == 72 || $postCode == 53 || $postCode == 35 || $postCode == 22
				|| $postCode == 56 || $postCode == 44 || $postCode == 49 || $postCode == 37 || $postCode == 36 || $postCode == 85
				|| $postCode == 79 || $postCode == 86)
			{
				$tournament -> setRegion('Ouest');
			}
			$tournament -> setDateCreated(new \DateTime('now'));			
			$tournament -> setCurrent(false);
			$tournament -> setPlayed(false);
			$tournament -> setPlayedFuture(true);
			$tournament -> setOrganizer($this -> getUser());
			
			$em -> persist($tournament);
			$em -> flush();

			$session -> getFlashbag()->add('creatournoi','Le tournoi' . $tournament -> getName() . 'est bien créé!');
			return $this -> redirect($this->generateUrl('front_office_homepage'));
		}

		return $this -> render('FrontOfficeBundle:Tournament:newTournament.html.twig', 
			array('form'=> $form ->createView()));
	}

	public function listTournamentAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$tournaments = $em -> getRepository('FrontOfficeBundle:Tournament')->getTournaments();

		return $this -> render('FrontOfficeBundle:Tournament:list.html.twig', 
			array('tournaments'=>$tournaments));
	}

	public function editTournamentAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$tournament = $em -> getRepository('FrontOfficeBundle:Tournament')->find($id);
		$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);

		$form -> handleRequest($request);

		if ($form -> isValid()){
			$comment -> setTournament($tournament);
			$comment -> setDateCreated(new \DateTime());
			$comment -> setCensored(false);
			$comment -> setGroundComment(false);
			$comment -> setArticleComment(false);
			$comment -> setArticleComment(false);
			$comment -> setTeamComment(false);
			$comment -> setTournamentComment(true);
			$comment -> setValidationAdmin(false);
			$comment -> setAuthor($this -> getUser());
			$em -> persist($comment);
			$em -> flush();

			$session -> getFlashbag()-> add('notice','Merci pour votre commentraire !');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this -> render('FrontOfficeBundle:Tournament:edit.html.twig', 
			array('tournament'=>$tournament,
				  'form'      =>$form ->createview()));
	}

	public function updateTournamentAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$tournament = $em -> getRepository('FrontOfficeBundle:Tournament')->find($id); 
		$name = $tournament -> getName();
		$form = $this -> createForm(new TournamentType, $tournament);

		$form -> handleRequest($request);

		if($form -> isValid()){
			$em -> persist($tournament);
			$em -> flush();

			$session -> getFlashbag()->add('update', 'Vos modifications sont prises en compte !');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this -> render('FrontOfficeBundle:Tournament:updateTournament.html.twig', 
			array('name'=> $name,
				  'form'=> $form -> createView()));
	}
}