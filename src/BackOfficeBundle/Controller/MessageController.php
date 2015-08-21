<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$messages = $em -> getRepository('FrontOfficeBundle:Message')-> getMessage();

		return $this ->render('BackOfficeBundle:Message:list.html.twig', array('messages'=>$messages));
	}

	public function deleteAction(REquest $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$message = $em -> getRepository('FrontOfficeBundle:Message')->find($id);
		$em -> remove($message);
		$em -> flush();

		$session ->getFlashbag()->add('notice','Message supprimé !');
		return $this -> redirect($this -> generateUrl('back_office_message_list'));
	}

	public function readMessageAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request ->getSession();
		$readMessage = $em -> getRepository('FrontOfficeBundle:Message')->find($id);
		$readMessage -> setReadMessage(true);
		$readMessage -> setReader($this -> getUser());
		$em -> persist($readMessage);
		$em -> flush();

		$session -> getFlashbag()->add('succes','Message archivé !');
		return $this -> redirect($request -> headers -> get('referer'));
	}

	public function listReadMessageAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$listReadMessage = $em -> getRepository('FrontOfficeBundle:Message')-> getReadMessage();

		return $this -> render('BackOfficeBundle:Message:listReadMessage.html.twig', 
			array('listReadMessage'=>$listReadMessage));
	}
}