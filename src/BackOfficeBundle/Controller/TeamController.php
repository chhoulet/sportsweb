<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Team;
use FrontOfficeBundle\Form\TeamType;

class TeamController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$team = $em -> getRepository('FrontOfficeBundle:Team') -> getTeamUnvalidated();

		return $this -> render('BackOfficeBundle:Team:list.html.twig', 
			array('team'=> $team));
	}

	public function responseAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$team = $em -> getRepository('FrontOfficeBundle:Team') ->find($id);
		$team -> setValidationAdmin(true);
		$team -> setDateValidated(new \datetime('now'));
		$em -> persist($team);
		$em -> flush();

		return $this -> redirect($this -> generateUrl('back_office_list_team'));
	}

	public function deleteAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$team = $em -> getRepository('FrontOfficeBundle:Team') ->find($id);
		$em -> remove($team);
		$em -> flush();

		return $this -> redirect($this -> generateUrl('back_office_list_team'));
	}
}