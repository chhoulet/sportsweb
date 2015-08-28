<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Ground;
use FrontOfficeBundle\Form\GroundType;
use Symfony\Component\HttpFoundation\Request;

class GroundController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$grounds = $em -> getRepository('FrontOfficeBundle:Ground')->findAll();

		return $this -> render('BackOfficeBundle:Ground:list.html.twig', 
			array('grounds' => $grounds));
	}

	public function newAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$ground = new Ground();
		$session = $request -> getSession();
		$form = $this -> createForm(new GroundType(),$ground);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$ground -> setDateCreated(new \datetime('now'));
			$ground -> setValidAdmin(true);
			$ground -> setAuthor($this -> getUser());
			$postCode = $ground -> getPostCode();

			/*Attribution automatique de valeur à l'attribut Region selon la valeur de postCode*/
			if($postCode == 75 || $postCode == 77 || $postCode == 78 || $postCode == 91 || $postCode == 92 || $postCode == 93)
			{
				$ground -> setRegion('Ile-de-France');
			}

			if($postCode == 16 || $postCode == 17 || $postCode == 87 || $postCode == 23 || $postCode == 63 || $postCode == 15
				|| $postCode == 12 || $postCode == 81 || $postCode == 31 || $postCode == 32 || $postCode == 65 || $postCode == 64
				|| $postCode == 40 || $postCode == 47 || $postCode == 33 || $postCode == 24 || $postCode == 19 || $postCode == 46 
				|| $postCode == 82 || $postCode == 29)
			{
				$ground -> setRegion('Sud-Ouest');
			}

			if($postCode == 09 || $postCode == 66 || $postCode == 11 || $postCode == 34 || $postCode == 48 || $postCode == 30
				|| $postCode == 07 || $postCode == 43 || $postCode == 42 || $postCode == 69 || $postCode == 01 || $postCode == 74
				|| $postCode == 73 || $postCode == 38 || $postCode == 26 || $postCode == 05 || $postCode == 13 || $postCode == 63
				|| $postCode == 84 || $postCode == 04 || $postCode == 83 || $postCode == 06 || $postCode == 20)
			{
				$ground -> setRegion('Sud-Est');
			}

			if($postCode == 03 || $postCode == 71 || $postCode == 39 || $postCode == 25 || $postCode == 70 || $postCode == 58
				|| $postCode == 21 || $postCode == 68 || $postCode == 89 || $postCode == 10 || $postCode == 52 || $postCode == 88
				|| $postCode == 10 || $postCode == 52 || $postCode == 54 || $postCode == 67 || $postCode == 55 || $postCode == 57)
			{
				$ground -> setRegion('Est');
			}

			if($postCode == 59 || $postCode == 51 || $postCode == 08 || $postCode == 02 || $postCode == 60 || $postCode == 80
				|| $postCode == 62 || $postCode == 76)
			{
				$ground -> setRegion('Nord');
			}

			if($postCode == 27 || $postCode == 14 || $postCode == 50 || $postCode == 61 || $postCode == 28 || $postCode == 45
				|| $postCode == 18 || $postCode == 41 || $postCode == 72 || $postCode == 53 || $postCode == 35 || $postCode == 22
				|| $postCode == 56 || $postCode == 44 || $postCode == 49 || $postCode == 37 || $postCode == 36 || $postCode == 85
				|| $postCode == 79 || $postCode == 86)
			{
				$ground -> setRegion('Ouest');
			}

			$em ->persist($ground);
			$em -> flush();

			$session -> getFlashbag()-> add('succes','Un nouveau terrain vient d\'être ajouté dans la base !');
			return $this -> redirect($this -> generateUrl('back_office_ground_list'));
		}

		return $this -> render('BackOfficeBundle:Ground:new.html.twig', array('form' => $form ->createView()));
	}

	public function updateAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$ground = $em -> getRepository('FrontOfficeBundle:Ground')->find($id);
		$form = $this -> createForm(new GroundType(), $ground);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$ground -> setDateUpdated(new \datetime('now'));
			$em -> persist($ground);
			$em -> flush();

			$session -> getFlashbag() -> add('notice','Le terrain a bien été mis à jour !');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this -> render('BackOfficeBundle:Ground:update.html.twig', 
			array('form'=>$form->createView()));
	}

	public function deleteAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$ground = $em -> getRepository('FrontOfficeBundle:Ground')->find($id);
		$em -> remove($ground);
		$em -> flush();

		return $this -> redirect($this -> generateUrl('back_office_ground_list'));
	}

	public function validAdminGroundAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$validAdminGround = $em -> getRepository('FrontOfficeBundle:Ground')->validAdmin();

		return $this -> render('BackOfficeBundle:Ground:admin.html.twig', array('validAdminGround'=>$validAdminGround));
	}

	public function validGroundAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$ground = $em -> getRepository('FrontOfficeBundle:Ground')->find($id);
		$ground -> setValidAdmin(true);
		$ground -> setDateValidated(new \datetime('now'));
		$em -> flush();

		return $this -> redirect($request -> headers -> get('referer'));
	}

	public function statsAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$getGroundByNbInvitations = $em -> getRepository('FrontOfficeBundle:Ground') -> getGroundByNbInvitations();
		$getGroundsByNbUsers = $em -> getRepository('FrontOfficeBundle:Ground') -> getGroundsByNbUsers();
		$getGroundsByNbTeams = $em -> getRepository('FrontOfficeBundle:Ground') -> getGroundsByNbTeams();
		
		return $this -> render('BackOfficeBundle:Ground:stats.html.twig', 
			array('getGroundByNbInvitations' => $getGroundByNbInvitations,
				  'getGroundsByNbUsers'      => $getGroundsByNbUsers,
				  'getGroundsByNbTeams'      => $getGroundsByNbTeams));
	}
}