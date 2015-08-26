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
	public function newAction(Request $request, $userTo = null, $teamTo= null, $teamFrom = null)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$invitation = new Invitation();		
		$userSport = $this -> getUser() -> getFavouriteSport();
		$form = $this -> createForm(new InvitationType(), $invitation);

		if ($userTo || $teamTo || $teamFrom) {
			$userTo = $em -> getRepository('UserBundle:User') -> find($userTo); // peut-être NULL
			$teamTo = $em -> getRepository('FrontOfficeBundle:Team') -> find($teamTo);
			$teamFrom = $em -> getRepository('FrontOfficeBundle:Team') -> find($teamTo);
		}	
		
		$form -> handleRequest($request);

		/*Attribution de valeurs automatique aux invitations créées, permet le tri selon leur statut*/
		if ($form -> isValid()){

			#Recupération de la valeur de $postCode:
			$postCode = $invitation -> getPostCode();
			$invitation ->setDateCreated(new \DateTime('now'));
			$invitation ->setAccepted(false);
			$invitation ->setDenied(false);
			$invitation ->setUserFrom($this->getUser());
			$invitation ->setUser($this->getUser());
			$invitation ->setTeamFrom($teamFrom);
			$invitation ->setTeamTo($teamTo);
			$invitation ->setUserTo($userTo);
			$invitation ->setSport($userSport);

			if ($postCode == 75 || $postCode == 78 || $postCode == 91 || $postCode == 92 || $postCode == 93 || $postCode == 95)
			{
				$invitation -> setRegion('Ile-de-France');
			}

			if($postCode == 16 || $postCode == 17 || $postCode == 87 || $postCode == 23 || $postCode == 63 || $postCode == 15
				|| $postCode == 12 || $postCode == 81 || $postCode == 31 || $postCode == 32 || $postCode == 65 || $postCode == 64
				|| $postCode == 40 || $postCode == 47 || $postCode == 33 || $postCode == 24 || $postCode == 19 || $postCode == 46 || $postCode == 82)
			{
				$invitation -> setRegion('Sud-Ouest');
			}

			$em -> persist($invitation);
			$em -> flush();

			/*Parametrage du message flash*/
			$session ->getFlashBag()->add('succes','Votre invitation a bien été lancée !');

			return $this->redirect($this -> generateUrl('front_office_homepage'));
		}

		return $this ->render('FrontOfficeBundle:Invitation:new.html.twig', 
			array('form'  =>$form->createView(),
				  'userTo'=>$userTo,
				  'teamTo'=>$teamTo));
	}

	public function oneInvitationAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$oneInvitation = $em -> getRepository('FrontOfficeBundle:Invitation')->find($id);

		return $this -> render('FrontOfficeBundle:Invitation:oneInvitation.html.twig', 
			array('invit'=> $oneInvitation));
	}

	// Function d'acceptation de l'invitation, avec l'attribut accepted mis à true + date de l'acceptation implémentée automatiquement:
	public function responseAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$invitation = $em -> getRepository('FrontOfficeBundle:Invitation') -> find($id);
		$invitation -> setAccepted(true);
		$invitation -> setDateAccepted(new \DateTime('now'));
		$invitation -> setUserTo($this->getUser());
		$em -> persist($invitation);
		$em -> flush();

		$session ->getFlashBag() ->add('repon', 'Vous venez d\'accepter cette invitation. Un e-mail de confirmation vient d\'être envoyé à l\'expéditeur. Bon match !');

		return $this-> redirect($this -> generateUrl('front_office_homepage'));
	}

	public function deniedAction(Request $request,$id)
	{
		/*Attribution automatique de valeur aux attributs de l'objet Invitation*/
		$em = $this -> getDoctrine()->getManager();
		$invitationDenied = $em -> getRepository('FrontOfficeBundle:Invitation')->find($id);
		$invitationDenied -> setDenied(true);
		$invitationDenied -> setDateDenied(new \datetime('now'));
		$invitationDenied -> setUserTo($this->getUser());
		$em -> persist($invitationDenied);
		$em -> flush();

		/*Redirection sur la page d'où vient l'user*/
		return $this -> redirect($request->headers->get('referer'));
	}

	public function deleteFromMonProfilAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$deleteFromMonProfil = $em -> getRepository('FrontOfficeBundle:Invitation')-> find($id);
		$deleteFromMonProfil -> setUserTo();
		$em -> persist($deleteFromMonProfil);
		$em -> flush();

		return $this -> redirect($request -> headers -> get('referer'));
	}

	public function deleteAction(Request $request,$id)
	{
		$em = $this -> getDoctrine()->getManager();
		$deleteInvitation = $em -> getRepository('FrontOfficeBundle:Invitation')->find($id);
		$em -> remove($deleteInvitation);
		$em -> flush();

		/*Redirection sur la page d'où vient l'user*/
		return $this -> redirect($request -> headers -> get('referer'));
	}
}