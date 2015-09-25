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

			$postcodes = array(75,77,78,91,92,93,95);
			if (in_array($postCode, $postcodes))
				$invitation -> setRegion('Ile-de-France');
			}

			$postcodes = array(16,17,87,23,63,15,12,81,31,32,65,64,40,47,33,24,19,46,82,29)
			if(in_array($postCode, $postcodes)
			{
				$invitation -> setRegion('Sud-Ouest');
			}

			$postcodes = array(09,66,11,34,48,30,07,43,42,69,01,74,73,38,26,05,13,63,84,04,83,06,20);
			if(in_array($postCode, $postcodes))				
			{
				$invitation -> setRegion('Sud-Est');
			}

			$postcodes = array(03,71,39,25,70,58,21,10,52,54,67,55,57,67,68);
			if(in_array($postCode, $postcodes))			
			{
				$invitation -> setRegion('Est');
			}

			$postcodes = array(59,51,08,02,60,80,62,76);
			if(in_array($postCode, $postcodes))
			{
				$invitation -> setRegion('Nord');
			}

			$postcodes = array(27,14,50,61,28,45,18,41,72,53,35,22,56,44,49,37,36,85,79,86);
			if(in_array($postCode, $postcodes))			
			{
				$invitation -> setRegion('Ouest');
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
		$invitationDenied -> setUserTo($this ->  getUser());
		$invitationDenied -> setDenied(true);
		$invitationDenied -> setDateDenied(new \datetime('now'));		
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