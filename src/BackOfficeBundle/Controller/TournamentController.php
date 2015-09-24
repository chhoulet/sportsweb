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
		$tournamentByUser = $em -> getRepository('UserBundle:User') ->getTournamentByUser();
		$tournamentByPostCode = $em -> getRepository('FrontOfficeBundle:Tournament') ->getTournamentsByPostCode();
		$tournamentByPlace = $em -> getRepository('FrontOfficeBundle:Tournament') ->getTournamentsByPlace();
		

		return $this -> render('BackOfficeBundle:Tournament:stats.html.twig', 
			array('tournamentBySports'  => $tournamentBySports,
				  'tournamentByRegion'  => $tournamentByRegion,
				  'tournamentByUser'    => $tournamentByUser,
				  'tournamentByPostCode'=> $tournamentByPostCode,
				  'tournamentByPlace'   => $tournamentByPlace));
	}
}