<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Matche;
use FrontOfficeBundle\Entity\Tournament;
use FrontOfficeBundle\Form\MatcheType;
use Symfony\Component\HttpFoundation\Request;

class MatcheController extends Controller
{
	public function newMatcheAction(Request $request,$id = null)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$tournament = $em -> getRepository('FrontOfficeBundle:Tournament')->find($id);
		/*$id_tournament = $tournament -> getId();*/
		$matche = new Matche();
		$form = $this -> createForm(new MatcheType, $matche);

		$form -> handleRequest($request);
	
		if ($form -> isValid()){
			$matche -> setPlayed(false);
			$matche -> setPlayedFuture(true);
			$matche -> setOrganizer($this -> getUser());
			$matche -> setSport($this -> getUser()->getFavouriteSport());
			$matche -> setTournament($tournament);
			$matche -> setMatchCancelled(false);
			$em -> persist($matche);
			$em -> flush();

			$session -> getFlashbag()->add('creaMatch', 'Votre match est planifié !');
			return $this -> redirect($this -> generateUrl('front_office_user_update'));
		}

		return $this -> render('FrontOfficeBundle:Matche:newMatche.html.twig', 
			array('form'=>$form->createView()));
	}

	public function cancelMatchAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$cancelMatch = $em -> getRepository('FrontOfficeBundle:Matche')->find($id);
		$cancelMatch -> setMatchCancelled(true);
		$em -> flush();

		$session -> getFlashbag()->add('annuMatch','Ce match est annulé !');
		return $this ->redirect($request-> headers ->get('referer'));
	}
}