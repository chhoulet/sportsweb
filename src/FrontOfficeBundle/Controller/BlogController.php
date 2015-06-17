<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Article;
use FrontOfficeBundle\Entity\Comment;
use FrontOfficeBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
	public function homepageAction(Request $request)
	{
		$em = $this -> getDoctrine()->getmanager();
		$article = $em -> getRepository('FrontOfficeBundle:Article')->getArticle();
		/*$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);

		$form -> handleRequest($request);

		if ($form -> isValid())
		{
			$comment -> setArticle($article);
			$comment -> setDateCreated(new \date('now'));
			$em -> persist($comment);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_blog_homepage'));
		}*/

		return $this -> render('FrontOfficeBundle:Blog:homepage.html.twig',
		    array('article' => $article
		    	  /*'form'    => $form ->createView()*/));

	}
		
	public function listAction()
	{
		$em = $this ->getDoctrine()->getManager();
		$article = $em -> getRepository('FrontOfficeBundle:Article') ->findAll();

		return $this -> render('FrontOfficeBundle:Blog:list.html.twig', 
			array('article' => $article));
	}

	public function oneAction(Request $request, $id)
	{
		$em = $this ->getDoctrine()->getManager();
		$article = $em -> getRepository('FrontOfficeBundle:Article') ->find($id);
		$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);

		$form -> handleRequest($request);

		if ($form -> isValid())
		{
			$comment -> setDateCreated(new \DateTime('now'));
			$comment -> setArticle($article);
			$em -> persist($comment);
			$em -> flush();

			return $this -> redirect($this ->generateurl('front_office_blog_one', array('id'=>$id)));
		}

		return $this -> render('FrontOfficeBundle:Blog:one.html.twig', 
			array('article'=> $article,
				  'form'   => $form -> createView()));
	}
}