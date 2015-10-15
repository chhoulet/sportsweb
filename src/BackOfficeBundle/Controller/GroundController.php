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
			$ground -> upload();
			$postCode = $ground -> getPostCode();

			/*Attribution automatique de valeur à l'attribut Region selon la valeur de postCode*/
			$postcodes = array(75,77,78,91,92,93,94,95);
			if(in_array($postCode, $postcodes))
			{
				$ground -> setRegion('Ile-de-France');
			}

			$postcodes = array(16,17,87,23,63,15,12,81,31,32,65,64,40,47,33,24,19,46,82,29);
			if(in_array($postCode, $postcodes))				
			{
				$ground -> setRegion('Sud-Ouest');
			}

			$postcodes = array(09,66,11,34,48,30,07,43,42,69,01,74,73,38,26,05,13,63,84,04,83,06,20);
			if(in_array($postCode, $postcodes))				
			{
				$ground -> setRegion('Sud-Est');
			}

			$postcodes = array(03,71,39,25,70,58,21,10,52,54,67,55,57,67,68);
			if(in_array($postCode, $postcodes))			
			{
				$ground -> setRegion('Est');
			}

			$postcodes = array(59,51,08,02,60,80,62,76);
			if(in_array($postCode, $postcodes))
			{
				$ground -> setRegion('Nord');
			}

			$postcodes = array(27,14,50,61,28,45,18,41,72,53,35,22,56,44,49,37,36,85,79,86);
			if(in_array($postCode, $postcodes))			
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

	public function deleteAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$ground = $em -> getRepository('FrontOfficeBundle:Ground')->find($id);
		$em -> remove($ground);
		$em -> flush();

		$session -> getFlashbag() -> add('succes','Ce terrain est supprimé !');
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
		$session = $request -> getSession();
		$ground = $em -> getRepository('FrontOfficeBundle:Ground')->find($id);
		$ground -> setValidAdmin(true);
		$ground -> setDateValidated(new \datetime('now'));
		$em -> flush();

		$session -> getFlashbag() -> add('valid','Ce terrain est validé !');
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