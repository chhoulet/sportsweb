<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Team;
use FrontOfficeBundle\Form\TeamType;

class TeamController extends Controller
{
	# Liste des teams non-validees:
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$team = $em -> getRepository('FrontOfficeBundle:Team') -> getTeamUnvalidated();

		return $this -> render('BackOfficeBundle:Team:list.html.twig', 
			array('team'=> $team));
	}

	# Liste des équipes inactives:
	public function getUnactiveTeamsAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$unactiveTeams = $em -> getRepository('FrontOfficeBundle:Team')->getUnactiveTeams();

		return $this -> render('BackOfficeBundle:Team:list.html.twig', 
			array('team'=>$unactiveTeams));
	}

	# Validation admin de la team selectionnee:
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

	# Suppression d'une team :
	public function deleteAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$team = $em -> getRepository('FrontOfficeBundle:Team') ->find($id);
		$em -> remove($team);
		$em -> flush();

		return $this -> redirect($this -> generateUrl('back_office_list_team'));
	}

	public function getTeamsByInvitationsSentAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$teamsByInvitationsSent = $em -> getRepository('FrontOfficeBundle:Team')->getTeamsByInvitationsSent();
		$teamsByInvitationsReceived = $em -> getRepository('FrontOfficeBundle:Team')->getTeamsByInvitationsReceived();		

		return $this -> render('BackOfficeBundle:Team:statistiquesTeams.html.twig', 
			array('teamsByInvitationsSent'    => $teamsByInvitationsSent,
				  'teamsByInvitationsReceived'=> $teamsByInvitationsReceived));
	}
}