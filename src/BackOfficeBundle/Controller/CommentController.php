<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Comment;

class CommentController extends Controller
{
	# Tri des comments, affichage des non-validés:
	public function adminAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$comments = $em -> getRepository('FrontOfficeBundle:Comment') -> getUnvalidatedComment();

		return $this -> render('BackOfficeBundle:Comment:admin.html.twig', 
			array('comments'=> $comments));
	}

	# Suppression des non-validés:
	public function deleteAction($id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$comment = $em -> getRepository('FrontOfficeBundle:Comment')->find($id);
		$em -> remove($comment);
		$em -> flush();
		
		return $this ->redirect($this -> generateUrl('front_office_blog_homepage'));
	}

	public function responseAction($id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$comment = $em -> getRepository('FrontOfficeBundle:Comment')->find($id);
		$comment -> setValidationAdmin(true);
		$comment -> setDateValidated(new \datetime('now'));
		$em -> persist($comment);
		$em -> flush();

		return $this -> redirect($this -> generateUrl('back_office_comment_admin'));
	}
}