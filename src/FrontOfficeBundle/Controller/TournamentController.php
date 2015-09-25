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
		$sport = $this -> getUser()->getFavouriteSport();
		$tournament = new Tournament();
		$postCode = $tournament -> getPostCode();
		$form = $this -> createForm(new TournamentType(), $tournament);

		$form -> handleRequest($request);


		if ($form -> isValid())
		{		
			$postcodes = array(75,77,78,91,92,93,95);
			if(in_array($postCode, $postcodes))
			{
				$tournament -> setRegion('Ile-de-France');
			}

			$postcodes = array(16,17,87,23,63,15,12,81,31,32,65,64,40,47,33,24,19,46,82,29);
			if(in_array($postCode, $postcodes))				
			{
				$tournament -> setRegion('Sud-Ouest');
			}

			$postcodes = array(09,66,11,34,48,30,07,43,42,69,01,74,73,38,26,05,13,63,84,04,83,06,20);
			if(in_array($postCode, $postcodes))				
			{
				$tournament -> setRegion('Sud-Est');
			}

			$postcodes = array(03,71,39,25,70,58,21,10,52,54,67,55,57,67,68);
			if(in_array($postCode, $postcodes))			
			{
				$tournament -> setRegion('Est');
			}

			$postcodes = array(59,51,08,02,60,80,62,76);
			if(in_array($postCode, $postcodes))
			{
				$tournament -> setRegion('Nord');
			}

			$postcodes = array(27,14,50,61,28,45,18,41,72,53,35,22,56,44,49,37,36,85,79,86);
			if(in_array($postCode, $postcodes))			
			{
				$tournament -> setRegion('Ouest');
			}

											
			$tournament -> setDateCreated(new \DateTime('now'));			
			$tournament -> setCurrent(false);
			$tournament -> setPlayed(false);
			$tournament -> setPlayedFuture(true);
			$tournament -> setOrganizer($this -> getUser());
			$tournament -> setSport($sport);
			
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

			$session -> getFlashbag()-> add('notice','Merci pour votre commentaire !');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this -> render('FrontOfficeBundle:Tournament:edit.html.twig', 
			array('tournament'=> $tournament,
				  'form'      => $form ->createview()));
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