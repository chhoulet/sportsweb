<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Article;
use FrontOfficeBundle\Form\ArticleType;
use FrontOfficeBundle\Entity\Comment;
use FrontOfficeBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
	public function homepageAction(Request $request)
	{
		$em = $this -> getDoctrine()->getmanager();
		$article = $em -> getRepository('FrontOfficeBundle:Article')-> getArticle();

		#Code permettant la creation des articles du blog :
		$articleUser = new Article();
		$formArticle = $this -> createForm(new ArticleType(), $articleUser);
		$formArticle ->handleRequest($request);
		if ($formArticle -> isValid())
		{
			$articleUser -> setDateCreated(new \datetime('now'));
			$articleUser -> setValidationAdmin(false);
			$articleUser -> setWarned(false);
			$em -> persist($articleUser);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_blog_homepage'));
		}
		
		return $this -> render('FrontOfficeBundle:Blog:homepage.html.twig',
		    array('articles' => $article,		    	 
		    	  'formArticle'=> $formArticle -> createView()));
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
			$comment ->setValidationAdmin(false);
			$em -> persist($comment);
			$em -> flush();

			return $this -> redirect($this ->generateurl('front_office_blog_one', array('id'=>$id)));
		}

		return $this -> render('FrontOfficeBundle:Blog:one.html.twig', 
			array('article'=> $article,
				  'form'   => $form -> createView()));
	}

	public function triBySportAction($sport)
	{
		$em = $this ->getDoctrine()->getManager();
		$triArticles = $em -> getRepository('FrontOfficeBundle:Article') -> triArticle($sport);		

		return $this -> render('FrontOfficeBundle:Blog:tribysport.html.twig', array('articles'=>$triArticles));
	}
}