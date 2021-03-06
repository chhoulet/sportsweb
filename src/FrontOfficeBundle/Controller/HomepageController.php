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
       /* $serv = $this->get('nom_de_mon_service');*/
 
        $em = $this -> getDoctrine()->getManager();      

        if ($this -> getUser())
        {
            # Recuperation du sport favori des sportpracticed et de la region de l'user connecte:
            $sport = $this -> getUser() -> getFavouriteSport();            
            $sportPracticed = $this -> getUser() -> getSportPracticed();
            $region = $this -> getUser()-> getRegion();            	    
 
            # On recupere les id de tous les sports pratiqués de l'user, on les stocke dans un tableau:
            $sportPracticedList = array();
            for($i=0;$i<count($sportPracticed);$i++){
                array_push($sportPracticedList, $sportPracticed[$i]->getId());
            }
            
            # Transformation du tableau en chaine de caractere pour pouvoir etre lu par la requete sql:
            $idsSport = join(',',$sportPracticedList);  

            # Appel des functions triant les invitations par le sport favori de l'user:
            $triInvitsBySport = $em -> getRepository('FrontOfficeBundle:Invitation') 
                -> triInvitsBySport($sport, $region);

            # Par les sports pratiqués par l'user:
            $triInvitsBySportPracticed = $em -> getRepository('FrontOfficeBundle:Invitation') 
                -> triBySportPlace($idsSport, $region);                 
                                  
            return $this->render('FrontOfficeBundle:Homepage:homepage.html.twig', 
                array('invitsBySport'         => $triInvitsBySport,
                      'invitsBySportPracticed'=> $triInvitsBySportPracticed));               
        }

        else
        {              
            # Tri des invitations:
            $form = $this -> createForm(new TriInvitationType());

            $form -> handleRequest($request);

            /*Recuperation des donnees du formulaire, utilisées en parametres de la function triant les invits*/
            if ($form -> isValid()){


                $datas = $form -> getData();
                $invits = $em -> getRepository('FrontOfficeBundle:Invitation') -> triBySportPlace($datas['sport']->getId(), $datas['region']);

//var_dump($datas);exit;

                return $this -> render('FrontOfficeBundle:Invitation:triBySportPlace.html.twig', array('invits'=>$invits));
            }

    	    $allInvit = $em -> getRepository('FrontOfficeBundle:Invitation') -> getInvitation();            

            if($allInvit != ''){
                return $this->render('FrontOfficeBundle:Homepage:homepage.html.twig', 
            	    array('allInvit'=> $allInvit, 
                          'form'    => $form ->createView()));                
            }

            else{
                return $this ->render('FrontOfficeBundle:Homepage:homepage.html.twig',
                    array('form'    => $form ->createView()));
            }
        }                		  
    }
}
