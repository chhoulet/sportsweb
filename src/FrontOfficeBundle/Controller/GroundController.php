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
			$comment -> setTeamComment(false);
			$comment -> setGroundComment(true);
			$comment -> setTournamentComment(false);
			$comment -> setArticleComment(false);
			$comment -> setCensored(false);
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
			$ground -> upload();

			/*Attribution automatique de valeur à l'attribut Region selon la valeur de postCode*/
			$postcodes = array(75,77,78,91,92,93,94,95);
			if(in_array($postCode, $postcodes))
			{
				$ground -> setRegion('Ile-de-France');
			}

			$postcodes = array(16,17,87,23,63,15,12,81,31,32,65,64,40,47,33,24,19,46,82,29);
			if(in_array($postCode, $postcodes))				
			{
				$ground -> setRegion('Sud-Ouest');
			}

			$postcodes = array(09,66,11,34,48,30,07,43,42,69,01,74,73,38,26,05,13,63,84,04,83,06,20);
			if(in_array($postCode, $postcodes))				
			{
				$ground -> setRegion('Sud-Est');
			}

			$postcodes = array(03,71,39,25,70,58,21,10,52,54,67,55,57,67,68);
			if(in_array($postCode, $postcodes))			
			{
				$ground -> setRegion('Est');
			}

			$postcodes = array(59,51,08,02,60,80,62,76);
			if(in_array($postCode, $postcodes))
			{
				$ground -> setRegion('Nord');
			}

			$postcodes = array(27,14,50,61,28,45,18,41,72,53,35,22,56,44,49,37,36,85,79,86);
			if(in_array($postCode, $postcodes))			
			{
				$ground -> setRegion('Ouest');
			}

			$em -> persist($ground);
			$em -> flush();

			$session -> getFlashbag()->add('notice','Votre terrain vient d\'etre ajouté à la base de données ! Merci');
			return $this -> redirect($this->generateUrl('front_office_ground_list'));
		}

		return $this ->render('FrontOfficeBundle:Ground:newGround.html.twig', array('form'=> $form->createView()));
	}
}