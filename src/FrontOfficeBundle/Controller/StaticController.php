<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StaticController extends Controller
{
	public function conditionsAction()
	{
		return $this -> render('FrontOfficeBundle:Static:conditions.html.twig');
	}

	public function mentionsAction()
	{
		return $this -> render('FrontOfficeBundle:Static:mentions.html.twig');
	}


}