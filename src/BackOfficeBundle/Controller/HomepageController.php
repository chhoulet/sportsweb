<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction()
    {
        return $this->render('BackOfficeBundle:Homepage:homepage.html.twig');
    }
}
