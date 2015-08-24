<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Invitation;
use FrontOfficeBundle\Form\TriInvitationType;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends Controller
{
    public function homepageAction(Request $request)
    {
    	$em = $this -> getDoctrine()->getManager();
        # Recuperation du sport favori de l'user connecte.
        $sport = $this -> getUser() -> getFavouriteSport();
        
    	# Appel des functions triant les invitations par sport et par:
        $triInvitsBySport = $em -> getRepository('FrontOfficeBundle:Invitation') -> triInvitsBySport($this -> getUser(), $sport);   
    	$allInvit = $em -> getRepository('FrontOfficeBundle:Invitation') -> getInvitation();
        $form = $this -> createForm(new TriInvitationType);

        $form -> handleRequest($request);

        /*Recuperation des donnees du formulaire, utilisées en parametres de la function triant les invits*/
        if ($form -> isValid()){
            $datas = $form -> getData();
            $invits = $em -> getRepository('FrontOfficeBundle:Invitation') -> triBySportPlace($datas['sport'], $datas['place']);

            return $this -> render('FrontOfficeBundle:Invitation:triBySportPlace.html.twig', array('invits'=>$invits));
        }
    	

        return $this->render('FrontOfficeBundle:Homepage:homepage.html.twig', 
        	array('invitForConnectedUser' => $triInvitsBySport,
        		  'allInvit'              => $allInvit,
                  'form'                  => $form ->createView() ));
    }
}
