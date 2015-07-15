<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Message;
use FrontOfficeBundle\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;


class StaticController extends Controller
{
	public function conditionsAction()
	{
		return $this -> render('FrontOfficeBundle:Static:conditions.html.twig');
	}

	public function mentionsAction()
	{
		return $this -> render('FrontOfficeBundle:Static:mentions.html.twig');
	}

	public function contactAction(Request $request)
	{
		$em = $this -> getDoctrine()-> getManager();
		$message = new Message();
		$session = $request -> getSession();
		$form = $this -> createForm(new MessageType(), $message);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$message ->setDateCreated(new \datetime('now'));
			$message ->setReadMessage(false);
			$em -> persist($message);
			$em -> flush();

			$session -> getFlashbag()-> add('info', 'Votre message a bien été envoyé à l\'administrateur');
			return $this -> redirect($this -> generateUrl('front_office_homepage'));
		}

		return $this -> render('FrontOfficeBundle:Static:contact.html.twig', array('form' => $form -> createView()));
	}

}