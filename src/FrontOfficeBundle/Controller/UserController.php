<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackOfficeBundle\User;
use UserBundle\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
	// Function pour faire apparaître Mon Profil, avec lien en homepage
	/*public function updateAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $em -> getRepository('UserBundle:User')->find($id);
		$form = $this -> createForm(new RegistrationFormType(), $user);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$user ->setValidationAdmin(false);
			$em -> persist($user);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_show_user'));
		}

		return $this -> render('FrontOfficeBundle:User:update.html.twig', 
			array('user'=>$user,
				  'form'=>$form->createView()));
	}*/
	/*Faire apparaitre Mon profil:*/
	public function showUserAction()
	{
		return $this -> render('FrontOfficeBundle:User:showUser.html.twig');
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
	public function getFriendAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$friend = $em -> getRepository('UserBundle:User') -> find($id);
		# Récupérer l'id de l'user connecté et lui attribuer un ami :
		$this -> getUser() -> addFriend($friend);
		//$em -> persist($friend);
		$em -> flush();

		return $this -> redirect($this -> generateUrl('front_office_users_list'));
	}

	public function showFriendsAction()
	{
		return $this -> render('FrontOfficeBundle:User:showFriends.html.twig');
	}

	public function showInvitationsAction()
	{
		return $this -> render('FrontOfficeBundle:User:showInvitations.html.twig');
	}
}
