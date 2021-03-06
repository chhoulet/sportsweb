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
		$session = $request -> getSession();
		$sports = $em -> getRepository('FrontOfficeBundle:Sport')->findAll();
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
			$articleUser -> setArchived(false);
			$articleUser -> addAuthor($this -> getUser());
			$em -> persist($articleUser);
			$em -> flush();

			$session -> getFlashbag() -> add('succes','Votre article a bien été enregistré ! Il est en cours de validation et sera prochainement posté. Merci');
			return $this -> redirect($this -> generateUrl('front_office_blog_homepage'));
		}
		
		return $this -> render('FrontOfficeBundle:Blog:homepage.html.twig',
		    array('sports'     => $sports,
		    	  'articles'   => $article,		    	 
		    	  'formArticle'=> $formArticle -> createView()));
	}	

	/*Selection d'un article avec formulaire de creation de commentaires + message flash*/
	public function oneAction(Request $request, $id)
	{
		$em = $this ->getDoctrine()->getManager();
		$session = $request -> getSession();
		$sports = $em -> getRepository('FrontOfficeBundle:Sport')->findAll();
		$article = $em -> getRepository('FrontOfficeBundle:Article') ->find($id);
		$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);

		$form -> handleRequest($request);

		if ($form -> isValid())
		{
			/*Attribution de valeurs automatique aux attributs de l'objet Comment*/
			$comment -> setDateCreated(new \DateTime('now'));
			$comment -> setArticle($article);
			$comment -> setValidationAdmin(false);
			$comment -> setAuthor($this -> getUser());
			$comment -> setTeamComment(false);
			$comment -> setGroundComment(false);
			$comment -> setTournamentComment(false);
			$comment -> setMatcheComment(false);
			$comment -> setCensored(false);
			$comment -> setArticleComment(true);
			$em -> persist($comment);
			$em -> flush();

			$session -> getFlashbag()->add('succes','Merci pour votre commentaire !');
			return $this -> redirect($this ->generateurl('front_office_blog_one', array('id'=>$id)));
		}

		return $this -> render('FrontOfficeBundle:Blog:one.html.twig', 
			array('sports' => $sports,
				  'article'=> $article,
				  'form'   => $form -> createView()));
	}

	public function triBySportAction(Request $request, $sport)
	{
		$em = $this ->getDoctrine()->getManager();
		$sports = $em -> getRepository('FrontOfficeBundle:Sport')->findAll();
		$triArticles = $em -> getRepository('FrontOfficeBundle:Article') -> triArticle($sport);	
		$newArticle = new Article();
		$session = $request -> getSession();
		$form = $this -> createForm(new ArticleType(),$newArticle);

		$form -> handleRequest($request);

		if ($form -> isValid())
		{
			$newArticle -> setDateCreated(new \datetime('now'));
			$newArticle -> setValidationAdmin(false);
			$newArticle -> setWarned(false);
			$newArticle -> setArchived(false);
			$newArticle -> addAuthor($this -> getUser());
			$em -> persist($newArticle);
			$em -> flush();

			$session -> getFlashbag()->add('articlecrea', 'Votre article est enregistré ! Il sera publié après validation. Merci !');
			return $this -> redirect($this -> generateUrl('front_office_blog_homepage'));	
		}

		return $this -> render('FrontOfficeBundle:Blog:tribysport.html.twig',
			array('form'    => $form -> createView(),
				  'sports'  => $sports,
				  'articles'=> $triArticles));
	}
}