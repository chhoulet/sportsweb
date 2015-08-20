<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackOfficeBundle\User;
use UserBundle\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
	// Function pour faire apparaître Mon Profil, avec lien en homepage
	public function updateAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $this ->getUser();
		$form = $this -> createForm(new RegistrationFormType(), $user);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$user -> setValidationAdmin(false);
			$user -> setDateValidated(new \DateTime());
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_user_update'));
		}

		return $this -> render('FrontOfficeBundle:User:update.html.twig', 
			array('user'=>$user,
				  'form'=>$form->createView()));
	}
	
	/*Liste des derniers utilisateurs inscrits:*/
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$listUsers = $em -> getRepository('UserBundle:User') -> showNewUsers();

		return $this -> render('FrontOfficeBundle:User:list.html.twig', 
			array('listUsers'=> $listUsers));
	}

	/*Vue du profil d'un utilisateur:*/
	public function oneAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $em -> getRepository('UserBundle:User') -> find($id);

		return $this -> render('FrontOfficeBundle:User:one.html.twig', array('user'=>$user));
	}

	# Marquer un autre user comme ami :
	public function getFriendAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$friend = $em -> getRepository('UserBundle:User') -> find($id);
		# Récupérer l'id de l'user connecté et lui attribuer un ami :
		$this -> getUser() -> addFriend($friend);
		//$em -> persist($friend);
		$em -> flush();

		return $this -> redirect($request->headers->get('referer'));
	}

	public function getOutFriendAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$friend = $em -> getRepository('UserBundle:User') -> find($id);
		$this -> getUser() -> removeFriend($friend);
		$em ->flush();

		return $this ->redirect($request -> headers -> get('referer'));
	}

	public function showFriendsAction()
	{
		return $this -> render('FrontOfficeBundle:User:showFriends.html.twig');
	}

	public function showInvitationsAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$invitation = $em -> getRepository('FrontOfficeBundle:Invitation') -> seeInvitationsForOneUser($this ->getUser());

		return $this -> render('FrontOfficeBundle:User:showInvitations.html.twig', 
			array('invitation'=>$invitation));
	}

	public function showTeamsAction()
	{
		return $this -> render('FrontOfficeBundle:User:showTeams.html.twig');
	}

	public function showArticlesAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$myArticles = $em -> getRepository('FrontOfficeBundle:Article')->getMyArticles($this -> getUser());

		return $this -> render('FrontOfficeBundle:User:showArticles.html.twig', 
			array('myArticles'=>$myArticles));
	}
}

