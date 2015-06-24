<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Invitation;
use FrontOfficeBundle\Form\InvitationType;
use Symfony\Component\HttpFoundation\Request;

class InvitationController extends Controller
{	
	/*Creation d'une invitation par un joueur, avec l'attribut accepted a false par défault:*/
	public function newAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$invitation = new Invitation();
		$form = $this -> createForm(new InvitationType(), $invitation);

		$form -> handleRequest($request);
		if ($form -> isValid()){
			$invitation ->setDateCreated(new \DateTime('now'));
			$invitation ->setAccepted(false);
			$em -> persist($invitation);
			$em -> flush();

			return $this->redirect($this->generateUrl('front_office_homepage'));
		}

		return $this ->render('FrontOfficeBundle:Invitation:new.html.twig', 
			array('form'=>$form->createView()));
	}

	// Function d'acceptation de l'invitation, avec l'attribut accepted mis à true + date de l'acceptation implémentée automatiquement:
	public function responseAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$invitation = $em -> getRepository('FrontOfficeBundle:Invitation') -> find($id);
		$invitation -> setAccepted(true);
		$invitation -> setDateAccepted(new \DateTime('now'));
		$em -> persist($invitation);
		$em -> flush();

		$this ->get('session') ->getFlashBag('success', 'Vous venez d\'accepter cette invitation. Un e-mail de confirmation vient de vous être envoyé. Bon match !');

		return $this-> redirect($this -> generateUrl('front_office_homepage'));
	}
}