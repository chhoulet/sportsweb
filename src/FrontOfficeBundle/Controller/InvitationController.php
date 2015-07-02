<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Invitation;
use FrontOfficeBundle\Form\InvitationType;
use Symfony\Component\HttpFoundation\Request;

class InvitationController extends Controller
{	
	/*Creation d'une invitation par un joueur, avec l'attribut accepted a false par défault. 
	Choix de la destination de l'invitation selon qu'elle est envoyée en homepage ou à un autre user avec if(userTo)*/
	public function newAction(Request $request, $userTo = null)
	{
		$em = $this -> getDoctrine()->getManager();
		$invitation = new Invitation();
		$form = $this -> createForm(new InvitationType(), $invitation);

		if ($userTo) {
			$userTo = $em -> getRepository('UserBundle:User') -> find($userTo); // peut-être NULL
		}
		
		$form -> handleRequest($request);

		if ($form -> isValid()){
			$invitation ->setDateCreated(new \DateTime('now'));
			$invitation ->setAccepted(false);
			$invitation ->setUserFrom($this->getUser());
			$invitation ->setUserTo($userTo);
			$em -> persist($invitation);
			$em -> flush();

			return $this->redirect($this->generateUrl('front_office_homepage'));
		}

		return $this ->render('FrontOfficeBundle:Invitation:new.html.twig', 
			array('form'  =>$form->createView(),
				  'userTo'=>$userTo));
	}

	// Function d'acceptation de l'invitation, avec l'attribut accepted mis à true + date de l'acceptation implémentée automatiquement:
	public function responseAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$invitation = $em -> getRepository('FrontOfficeBundle:Invitation') -> find($id);
		$invitation -> setAccepted(true);
		$invitation -> setDateAccepted(new \DateTime('now'));
		$invitation -> setUserTo($this->getUser());
		$em -> persist($invitation);
		$em -> flush();

		$this ->get('session') ->getFlashBag('success', 'Vous venez d\'accepter cette invitation. Un e-mail de confirmation vient de vous être envoyé. Bon match !');

		return $this-> redirect($this -> generateUrl('front_office_homepage'));
	}
}