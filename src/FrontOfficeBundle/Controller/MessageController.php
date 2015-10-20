<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Message;
use FrontOfficeBundle\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends Controller
{
	public function newAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$user = $em -> getRepository('UserBundle:User')->find($id);
		$message = new Message();
		$form = $this -> createForm(new MessageType(), $message);

		$form -> handleRequest($request);

		if ($form -> isValid()){
			$message -> setAuthor($this -> getUser());
			$message -> setDateCreated(new \DateTime());
			$message -> setEmail($this -> getUser()->getEmail());
			$message -> setReadMessage(false);
			$message -> setReader($user);
			$em -> persist($message);
			$em -> flush();

			$session -> getFlashbag()->add('succes','Votre message est envoyé !');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this -> render('FrontOfficeBundle:Message:new.html.twig', 
			array('user'=> $user,
				  'form'=> $form -> createView()));
	}
}