<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Comment;

class CommentController extends Controller
{
	public function deleteAction($id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$comment = $em -> getRepository('FrontOfficeBundle:Comment')->find($id);
		$em -> remove($comment);
		$em -> flush();
		
		return $this ->redirect($this -> generateUrl('front_office_blog_homepage'));
	}
}