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

	public function deleteAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$message = $em -> getRepository('FrontOfficeBundle:Message')->find($id);
		$em -> remove($message);
		$em -> flush();

		return $this -> redirect($this -> generateUrl('back_office_message_list'));
	}
}