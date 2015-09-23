<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Tournament;

class TournamentController extends Controller
{
	public function statsAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$tournamentBySports = $em -> getRepository('FrontOfficeBundle:Sport') ->getTournamentsBySport();
		$tournamentByRegion = $em -> getRepository('FrontOfficeBundle:Tournament') ->getTournamentsByRegion();

		

		return $this -> render('BackOfficeBundle:Tournament:stats.html.twig', 
			array('tournamentBySports' => $tournamentBySports,
				  'tournamentByRegion' => $tournamentByRegion));
	}
}