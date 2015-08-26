<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
	# Tri des comments, affichage des non-validés:
	public function adminAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$commentsTeam = $em -> getRepository('FrontOfficeBundle:Comment') -> getUnvalidatedCommentTeam();
		$commentsArticle = $em -> getRepository('FrontOfficeBundle:Comment') -> getUnvalidatedCommentArticle();
		$commentsGround = $em -> getRepository('FrontOfficeBundle:Comment') -> getUnvalidatedCommentGround();

		return $this -> render('BackOfficeBundle:Comment:admin.html.twig', 
			array('commentsTeam'   => $commentsTeam,
				  'commentsArticle'=> $commentsArticle,
				  'commentsGround' => $commentsGround));
	}

	# Suppression des non-validés:
	public function deleteAction($id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$comment = $em -> getRepository('FrontOfficeBundle:Comment')->find($id);
		$em -> remove($comment);
		$em -> flush();
		
		return $this ->redirect($this -> generateUrl('back_office_comment_admin'));
	}

	# Validation des comments :
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

	# Censure d'un commentaire :
	public function censoreCommentAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request->getSession();		
		$comment = $em -> getRepository('FrontOfficeBundle:Comment')->find($id);
		$comment -> setContent('Ce message est supprimé ! Il ne correspond pas aux règles d\'utilisation de ce forum!');
		$comment -> setCensored(true);
		$comment -> setDateCensored(new \datetime('now'));		

		$em -> flush();

		$session -> getFlashbag()->add('notice','Ce commentaire est censuré !');
		return $this ->redirect($request -> headers -> get('referer'));
	}
}