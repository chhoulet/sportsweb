<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Ground;
use FrontOfficeBundle\Form\GroundType;
use Symfony\Component\HttpFoundation\Request;

class GroundController extends Controller
{
	public function newAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$ground = new Ground();
		$form = $this -> createForm(new GroundType(),$ground);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$ground -> setDateCreated(new \datetime('now'));
			$em ->persist($ground);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('back_office_homepage'));
		}

		return $this -> render('BackOfficeBundle:Ground:new.html.twig', array('form' => $form ->createView()));
	}
}