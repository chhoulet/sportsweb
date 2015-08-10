<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserController extends Controller
{
	/*Selection des users non valides par admin*/
	public function adminAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $em -> getRepository('UserBundle:User') -> getAdminUser();

		return $this -> render('BackOfficeBundle:User:admin.html.twig', array('user'=> $user));
	}

	/*Validation admin si profil correct*/
	public function responseAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $em -> getRepository('UserBundle:User') -> find ($id);
		$user -> setValidationAdmin(true);
		$user -> setUserWarned(false);
		$user -> setDateValidated(new \datetime('now'));
		$em -> persist($user);
		$em -> flush();

		return $this -> redirect($this->generateurl('back_office_admin_user'));
	}

	/*Mise en écart si profil inconvenant*/
	public function warnedAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $em -> getRepository('UserBundle:User') -> find ($id);
		$user -> setUserWarned(true);
		$user -> setDateWarned(new \datetime('now'));
		$em -> persist($user);
		$em -> flush();

		return $this -> redirect($this->generateurl('back_office_admin_user'));
	}

	/*Liste des users mis a l'ecart*/
	public function warnedUsersAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$warnedUsers = $em -> getRepository('UserBundle:User') -> getWarnedUsers();

		return $this -> render('BackOfficeBundle:User:warnedUsers.html.twig', 
			array('warnedUsers' => $warnedUsers));
	}

	/*Suppression du compte user*/
	public function deleteAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $em -> getRepository('UserBundle:User') -> find ($id);
		$em -> remove($user);
		$em -> flush();

		return $this -> redirect($this -> generateUrl('back_office_admin_user'));
	}

	public function statsAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$getNbCommentsByUsers = $em -> getRepository('UserBundle:User') -> getNbCommentsByUsers();

		return $this -> render('BackOfficeBundle:User:stats.html.twig', 
			array('getNbCommentsByUsers'=>$getNbCommentsByUsers));
	}
}