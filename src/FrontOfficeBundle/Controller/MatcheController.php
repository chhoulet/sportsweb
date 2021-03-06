<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Matche;
use FrontOfficeBundle\Entity\Tournament;
use FrontOfficeBundle\Entity\Comment;
use FrontOfficeBundle\Form\MatcheType;
use FrontOfficeBundle\Form\CommentType;
use FrontOfficeBundle\Form\ScoreType;
use Symfony\Component\HttpFoundation\Request;

class MatcheController extends Controller
{
	public function newMatcheAction(Request $request,$id = null)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$tournament = $em -> getRepository('FrontOfficeBundle:Tournament')->find($id);		
		$matche = new Matche();
		$form = $this -> createForm(new MatcheType, $matche);

		$form -> handleRequest($request);
	
		if ($form -> isValid()){
			$matche -> setPlayed(false);
			$matche -> setPlayedFuture(true);
			$matche -> setOrganizer($this -> getUser());
			$matche -> setSport($this -> getUser()->getFavouriteSport());
			$matche -> setTournament($tournament);
			$matche -> setMatchCancelled(false);
			$em -> persist($matche);
			$em -> flush();

			$session -> getFlashbag()->add('creaMatch', 'Votre match est planifié !');
			return $this -> redirect($this -> generateUrl('front_office_user_update'));
		}

		return $this -> render('FrontOfficeBundle:Matche:newMatche.html.twig', 
			array('form'=>$form->createView()));
	}

	public function cancelMatchAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$cancelMatch = $em -> getRepository('FrontOfficeBundle:Matche')->find($id);
		$cancelMatch -> setMatchCancelled(true);
		$em -> flush();

		$session -> getFlashbag()->add('annuMatch','Ce match est annulé !');
		return $this ->redirect($request-> headers ->get('referer'));
	}

	public function myProfilListAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$tournament = $em -> getRepository('FrontOfficeBundle:tournament')->find($id);

		if($tournament){
			$futuresMatches = $em -> getRepository('FrontOfficeBundle:Matche')
				->getFuturesMatchesByTournament($tournament, $this -> getUser());
			$playedMatches = $em -> getRepository('FrontOfficeBundle:Matche')
				->getPlayedMatchesByTournament($tournament, $this -> getUser());

			return $this -> render('FrontOfficeBundle:Matche:myProfilList.html.twig', 
				array('tournament'    =>$tournament,
					  'futuresMatches'=>$futuresMatches,
					  'playedMatches' =>$playedMatches));
		}

		else{
			return $this -> render('FrontOfficeBundle:Matche:myProfilList.html.twig');
		}
	}

	# Attribution du score au match :
	public function getScoreAction(Request $request, $id)
	{
		$em = $this-> getDoctrine()-> getManager();
		$session = $request -> getSession();

		# Récuperation de l'id du matche dont on veut compléter le score:
		$matche = $em -> getRepository('FrontOfficeBundle:Matche')-> find($id);

		# Appel du formulaire d'implémentation du score:
		$form = $this -> createForm(new ScoreType(), $matche);

		$form -> handleRequest($request);

		# Paramétrage de l'objet Matche en fonction des données du formulaire:
		if($form -> isValid()){
				$matche -> setPlayed(true);
				$matche -> setPlayedFuture(false);				
				
				# Recuperation du score des équipes :
				$scoreTeam1 = $matche ->getScoreTeam1();
				$scoreTeam2 = $matche ->getScoreTeam2();

				/*var_dump($matche);*/	
				# Paramétrage des attributs de l'objet Matche en fonction du score:
				if($scoreTeam1 > $scoreTeam2){
					$matche -> setMatchWinnedTeam1(true);
					$matche -> setMatchWinnedTeam2(false);
					$matche -> setMatchLostTeam1(false);
					$matche -> setMatchLostTeam2(true);
					$matche -> setMatchNil(false);
					$em -> flush();

					$session -> getFlashbag()-> add('score', 'Merci d\'avoir renseigné le score');
					return $this -> redirect($this -> generateUrl('front_office_user_showMatches'));
				}

				elseif($scoreTeam1 < $ScoreTeam2){
					$matche -> setMatchWinnedTeam1(false);
					$matche -> setMatchWinnedTeam2(true);
					$matche -> setMatchLostTeam1(true);
					$matche -> setMatchLostTeam2(false);
					$matche -> setMatchNil(false);
					$em -> flush();

					$session -> getFlashbag()-> add('score', 'Merci d\'avoir renseigné le score');
					return $this -> redirect($this -> generateUrl('front_office_user_showMatches'));
				}
			
				elseif($scoreTeam1 = $ScoreTeam2){
					$matche -> setMatchWinnedTeam1(false);
					$matche -> setMatchWinnedTeam2(false);
					$matche -> setMatchLostTeam1(false);
					$matche -> setMatchLostTeam2(false);
					$matche -> setMatchNil(true);
					$em -> flush();

					$session -> getFlashbag()-> add('score', 'Merci d\'avoir renseigné le score');
					return $this -> redirect($this -> generateUrl('front_office_user_showMatches'));					
				}					

			# Redirection sur le template de presentation des matches:
			return $this -> redirect($this ->generateUrl('front_office_user_showMatches'));

			}

		return $this -> render("FrontOfficeBundle:Matche:scoreMatche.html.twig", 
			array('form'=> $form->createView()));
		}

		public function CommentAction(Request $request, $id)
		{
			$em = $this -> getDoctrine()-> getManager();
			$session = $request -> getSession();
			$id_Matche = $em -> getRepository('FrontOfficeBundle:Matche')->find($id);
			$comment = new Comment();
			$form = $this -> createForm(new CommentType(), $comment);

			$form -> handleRequest($request);

			if($form -> isValid()){
				$comment -> setDateCreated(new \DateTime('now'));
				$comment -> setAuthor($this -> getUser());
				$comment -> setMatche($id_Matche);
				$comment -> setValidationAdmin(false);
				$comment -> setCensored(false);
				$comment -> setTeamComment(false);
				$comment -> setArticleComment(false);
				$comment -> setGroundComment(false);
				$comment -> setTournamentComment(false);
				$comment -> setMatcheComment(true);
				$em -> persist($comment);
				$em -> flush();

				$session -> getFlashbag()->add('succes','Merci pour votre commentaire !');
				return $this -> redirect($this->generateUrl('front_office_user_showMatches'));
			}

			return $this -> render('FrontOfficeBundle:Matche:comment.html.twig', 
				array('id_Matche'=> $id_Matche,
					  'form'     => $form ->createView()));
		}
	
}