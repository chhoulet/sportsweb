<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Article;

class BlogController extends Controller
{
	public function homepageAction()
	{
		$em = $this ->getDoctrine()->getManager();
		$article = $em -> getRepository('FrontOfficeBundle:Article') -> getArticle();

		return $this ->render('FrontOfficeBundle:Blog:homepage.html.twig', 
			array('article'=>$article));
	}
}