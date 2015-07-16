<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Ground;
use FrontOfficeBundle\Form\GroundType;
use Symfony\Component\HttpFoundation\Request;

class GroundController extends COntroller
{
	public function groundListAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$groundList = $em -> getRepository('FrontOfficeBundle:Ground')->getGround();

		return $this -> render('FrontOfficeBundle:Ground:groundList.html.twig', 
			array('groundList'=>$groundList));
	}
}