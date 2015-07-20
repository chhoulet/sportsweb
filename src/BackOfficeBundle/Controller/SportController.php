<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Sport;
use FrontOfficeBundle\Form\SportType;
use Symfony\Component\HttpFoundation\Request;

class SportController extends Controller
{
	public function newAction(Request $request)
	{
		$em = $this -> getDoctrine()->getmanager();
		$sport = new Sport();
		$form = $this -> createForm(new SportType(),$sport);

		$form -> handleRequest($request);
		 if($form -> isValid())
		 {
		 	$sport -> setDateCreated(new \datetime('now'));
		 	$em -> persist($sport);
		 	$em -> flush();

		 	return $this -> redirect($this -> generateUrl('back_office_homepage'));
		 }

		return $this -> render('BackOfficeBundle:Sport:new.html.twig', 
			array('form'=> $form-> createView()));
	}

	public function listSportsAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$listSports = $em -> getRepository('FrontOfficeBundle:Sport')->findAll();
		$getSportsByUsers = $em -> getRepository('FrontOfficeBundle:Sport')->getSportsByUsers();
		$getSportsByGround = $em -> getRepository('FrontOfficeBundle:Sport')->getSportsByGround();

		return $this -> render('BackOfficeBundle:Sport:listSports.html.twig', 
			array('getSportsByUsers' => $getSportsByUsers,
				  'listSports'       => $listSports,
				  'getSportsByGround'=> $getSportsByGround));
	}

}
