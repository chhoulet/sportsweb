<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Ground;
use FrontOfficeBundle\Form\GroundType;
use FrontOfficeBundle\Entity\Comment;
use FrontOfficeBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;

class GroundController extends Controller
{
	public function groundListAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$groundList = $em -> getRepository('FrontOfficeBundle:Ground')->getGround();

		return $this -> render('FrontOfficeBundle:Ground:groundList.html.twig', 
			array('groundList'=>$groundList));
	}

	public function oneGroundAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$oneGround = $em ->getRepository('FrontOfficeBundle:Ground')->find($id);
		$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);
		$session = $request -> getSession();

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$comment -> setValidationAdmin(false);
			$comment -> setDateCreated(new \datetime());
			$comment -> setAuthor($this->getUser());
			$comment -> setGround($oneGround);
			$em -> persist($comment);
			$em -> flush();

			$session -> getFlashbag() -> add('succes','Merci pour votre commentaire !');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this -> render('FrontOfficeBundle:Ground:oneGround.html.twig', 
			array('oneGround'=>$oneGround,
				  'form'=>$form->createView()));
	}

	public function newGroundAction(Request $request)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$ground = new Ground();
		$form = $this -> createForm(new GroundType(), $ground);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$ground -> setDateCreated(new \datetime('now'));
			$ground -> setAuthor($this -> getUser());
			$ground -> setValidAdmin(false);
			$em -> persist($ground);
			$em -> flush();

			$session -> getFlashbag()->add('notice','Votre terrain vient d\'etre ajouté à la base de données ! Merci');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this ->render('FrontOfficeBundle:Ground:newGround.html.twig', array('form'=> $form->createView()));
	}
}