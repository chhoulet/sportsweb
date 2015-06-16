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
		$em = $this ->getDoctrine()->getManager();
		$article = $em -> getRepository('FrontOfficeBundle:Article') -> getArticle();
		$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);

		$form -> handleRequest($request);

		if ($form -> isValid())
		{
			$comment -> setDateCreated(new \DateTime('now'));
			$comment ->setArticle($article);
			$em -> persist($comment);
			$em -> flush();

			return $this -> redirect($this ->generateurl('front_office_blog_homepage'));
		}

		return $this ->render('FrontOfficeBundle:Blog:homepage.html.twig', 
			array('article'=> $article,
				  'form'   => $form -> createView()));
	}

	public function listAction($category)
	{
		$em = $this ->getDoctrine()->getManager();
		$article = $em -> getRepository('FrontOfficeBundle:Article') ->triArticle($category);

		return $this -> render('FrontOfficeBundle:Blog:list.html.twig', 
			array('article' => $article));
	}
}