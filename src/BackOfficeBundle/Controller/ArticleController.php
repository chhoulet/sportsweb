<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Article;
use FrontOfficeBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    public function listAction()
    {
        $em = $this -> getDoctrine()->getManager();
        $article = $em -> getRepository('FrontOfficeBundle:Article') -> findAll();

        return $this -> render('BackOfficeBundle:Article:list.html.twig',
            array('article'=>$article));
    }

    public Function newAction(Request $request)
    {
        $em = $this -> getDoctrine()->getManager();
        $article = new Article();
        $form = $this -> createForm(new ArticleType(), $article);

        $form -> handleRequest($request);
        if ($form -> isValid())
        {
            $article -> setDateCreated(new \DateTime('now'));
            $article -> setValidationAdmin(true);
            $article -> setWarned(true);
            $em -> persist($article);
            $em -> flush();

            return $this -> redirect($this -> generateUrl('back_office_homepage'));
        }

        return $this -> render('BackOfficeBundle:Article:new.html.twig',
            array('form' => $form ->createView()));
    }

    public function deleteAction($id)
    {
        $em = $this -> getDoctrine()->getManager();
        $article = $em -> getRepository('FrontOfficeBundle:Article') -> find($id);
        $em -> remove($article);
        $em -> flush();

        return $this ->redirect($this -> generateUrl('back_office_article_admin'));
    }

    public function adminAction()
    {
        $em = $this -> getDoctrine()-> getManager();
        $article = $em -> getRepository('FrontOfficeBundle:Article') -> validArticle();

        return $this -> render('BackOfficeBundle:Article:admin.html.twig', 
            array('article' => $article));
    }

    public function responseAction($id)
    {
        $em = $this -> getDoctrine()->getManager();
        $article = $em -> getRepository('FrontOfficeBundle:Article') -> find($id);
        $article -> setValidationAdmin(true);
        $article -> setDateValidated(new \DateTime('now'));
        $em -> persist($article);
        $em -> flush($article);

        return $this -> redirect($this -> generateUrl('back_office_article_admin'));
    }

    public function updateAction(Request $request,$id)
    {
        $em = $this -> getDoctrine()->getManager();
        $article = $em -> getRepository('FrontOfficeBundle:Article') -> find($id);

        $form = $this -> createForm(new ArticleType(), $article);

        $form -> handleRequest($request);
        if ($form -> isValid())
        {
            $article -> setDateUpdated(new \DateTime('now'));
            $em -> persist($article);
            $em -> flush();

            return $this -> redirect($this -> generateUrl('back_office_article_list'));
        }

        return $this -> render('BackOfficeBundle:Article:update.html.twig',
            array('form' => $form -> createView()));
    }

    public function warnedArticleAction($id)
    {
        $em = $this -> getDoctrine()->getManager();
        $warnedArticle = $em -> getRepository('FrontOfficeBundle:Article') -> find($id);
        $warnedArticle -> setWarned(true);
        $em -> persist($warnedArticle);
        $em -> flush();

        return $this -> redirect($this->generateUrl('back_office_article_admin'));
    }

    public function listArticlesWarnedAction()
    {
        $em = $this -> getDoctrine()->getManager();
        $listArticlesWarned = $em -> getRepository('FrontOfficeBundle:Article') -> getWarnedArticles();
        $nbArticlesWarned = $em -> getRepository('FrontOfficeBundle:Article') -> nbArticlesWarned();

        return $this -> render('BackOfficeBundle:Article:listArticlesWarned.html.twig',
            array('listArticlesWarned'=> $listArticlesWarned,
                  'nbArticlesWarned'  => $nbArticlesWarned));
    }

    public function responseWarnedArticleAction($id)
    {
         $em = $this -> getDoctrine()->getManager();
         $articleWarned = $em -> getRepository('FrontOfficeBundle:Article') -> find($id);
         $articleWarned ->setWarned(false);
         $articleWarned -> setValidationAdmin(true);
         $em -> persist($articleWarned);
         $em -> flush();

         return $this ->redirect($this -> generateUrl('back_office_article_list_articles_warned'));
    }

    public function articlesBySportAction()
    {
        $em = $this -> getDoctrine()-> getManager();
        $articlesBySport = $em -> getRepository('FrontOfficeBundle:Article') ->getArticlesBySport();
        $articlesByComment = $em -> getRepository('FrontOfficeBundle:Article') ->getArticlesByNbComment();
        $articlesByUsers = $em -> getRepository('UserBundle:User') -> getNbArticlesByUsers();

        return $this -> render('BackOfficeBundle:Article:statsArticles.html.twig', 
            array('articlesBySport'   => $articlesBySport,
                  'articlesByComment' => $articlesByComment,
                  'articlesByUsers'   => $articlesByUsers));
    }
}
