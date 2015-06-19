<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserController extends Controller
{
	public function adminAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $em -> getRepository('UserBundle:User') -> getAdminUser();

		return $this -> render('BackOfficeBundle:User:admin.html.twig', array('user'=> $user));
	}

	public function responseAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $em -> getRepository('UserBundle:User') -> find ($id);
		$user -> setValidationAdmin(true);
		$em -> persist($user);
		$em -> flush();

		return $this -> redirect($this->generateurl('back_office_admin_user'));
	}

	public function deleteAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$user = $em -> getRepository('UserBundle:User') -> find ($id);
		$em -> remove($user);
		$em -> flush();

		return $this -> redirect($this -> generateUrl('back_office_admin_user'));
	}
}