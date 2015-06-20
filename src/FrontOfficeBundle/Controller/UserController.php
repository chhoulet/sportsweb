<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackOfficeBundle\User;
use UserBundle\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
	public function updateAction(Request $request, $id)
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
	}
}
