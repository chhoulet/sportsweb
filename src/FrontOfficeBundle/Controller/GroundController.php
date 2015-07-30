<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Ground;
use FrontOfficeBundle\Form\GroundType;
use FrontOfficeBundle\Entity\Comment;
use FrontOfficeBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;

class GroundController extends Controller
{
	public function groundListAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$groundList = $em -> getRepository('FrontOfficeBundle:Ground')->getGround();

		return $this -> render('FrontOfficeBundle:Ground:groundList.html.twig', 
			array('groundList'=>$groundList));
	}

	/*Selection d'un Ground avec formulaire de creation de commentaires + message flash*/
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
			/*Attribution de valeurs automatique aux attributs de l'objet Comment*/
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
			/*Attribution de valeurs automatique aux attributs de l'objet Ground - auteur : recupération de l'user*/
			/*Récuperation de la valeur de postCode*/
			$postCode = $ground ->getPostCode();
			$ground -> setDateCreated(new \datetime('now'));
			$ground -> setAuthor($this -> getUser());
			$ground -> setValidAdmin(false);

			/*Attribution automatique de valeur à l'attribut Region selon la valeur de postCode*/
			if($postCode == 75 || $postCode == 77 || $postCode == 78 || $postCode == 91 || $postCode == 92 || $postCode == 93)
			{
				$ground -> setRegion('Ile-de-France');
			}

			if($postCode == 16 || $postCode == 17 || $postCode == 87 || $postCode == 23 || $postCode == 63 || $postCode == 15
				|| $postCode == 12 || $postCode == 81 || $postCode == 31 || $postCode == 32 || $postCode == 65 || $postCode == 64
				|| $postCode == 40 || $postCode == 47 || $postCode == 33 || $postCode == 24 || $postCode == 19 || $postCode == 46 || $postCode == 82)
			{
				$ground -> setRegion('Sud-Ouest');
			}

			$em -> persist($ground);
			$em -> flush();

			$session -> getFlashbag()->add('notice','Votre terrain vient d\'etre ajouté à la base de données ! Merci');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this ->render('FrontOfficeBundle:Ground:newGround.html.twig', array('form'=> $form->createView()));
	}
}