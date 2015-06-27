<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessageController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$messages = $em -> getRepository('FrontOfficeBundle:Message')-> getMessage();

		return $this ->render('BackOfficeBundle:Message:list.html.twig', array('messages'=>$messages));
	}
}