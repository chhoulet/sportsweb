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
}