<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Article;
use FrontOfficeBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    public Function newAction(Request $request)
    {
        $em = $this -> getDoctrine()->getManager();
        $article = new Article();
        $form = $this -> createForm(new ArticleType(), $article);

        $form -> handleRequest($request);
        if ($form -> isValid())
        {
            $article -> setDateCreated(new \DateTime('now'));
            $em -> persist($article);
            $em -> flush();

            return $this -> redirect($this -> generateurl('back_office_homepage'));
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

        return $this ->redirect($this -> generateUrl('front_office_blog_homepage'));
    }

}
