<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * InvitationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InvitationRepository extends EntityRepository
{
	# Query sélectionnant les 500 dernières invitations:
	public function getInvitation()
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i 
			WHERE i.accepted = false
			AND i.denied = false
			ORDER BY i.dateInvit ASC')
		->setMaxResults(500);

		return $query -> getResult();
	}

	# Query permettant un tri des invitations par sport:
	public function sportInvitation($sport)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i 
			JOIN i.sport s
			WHERE i.accepted = false 
			AND i.userTo is null
			AND s.name LIKE :sport
			ORDER BY i.dateInvit ASC')
		->setParameter('sport', $sport);

		return $query ->getResult();
	}

	# Query affichant les invitations acceptées par un user:
	public function seeInvitationsForOneUser($user)
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i 
			JOIN i.sport s 
			WHERE i.accepted = false 
			AND i.userTo is null 
			AND i.denied = false
			AND s.id IN (SELECT up.id FROM UserBundle:User u JOIN u.sportPracticed up WHERE u.id = :user)
			ORDER BY i.dateInvit ASC')						
		->setParameter('user', $user);

		return $query -> getResult();
	}

	# Somme des Invits postées :
	public function nbInvitations()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT COUNT(i.id) 
			FROM FrontOfficeBundle:Invitation i');

		return $query -> getSingleScalarResult();
	}

	# Nombre d'invitations acceptées :
	public function nbInvitationsAccepted()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT COUNT(i.id) 
			FROM FrontOfficeBundle:Invitation i
			WHERE i.accepted = true');

		return $query -> getSingleScalarResult();
	}

	# Nombre d'invitations non-acceptées :
	public function nbInvitationsDenied()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT COUNT(i.id) 
			FROM FrontOfficeBundle:Invitation i
			WHERE i.denied = true');

		return $query -> getSingleScalarResult();
	}

	# Tri des invits par destinataire :
	public function triInvitationByDestination($userTo)
	{
		$query = $this ->getEntityManager()->createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i
			WHERE i.userTo LIKE :userTo
			AND i.accepted = false')
		->setParameter('userTo', $userTo);

		return $query -> getResult();
	}

	# Tri des invits par sport et place:
	public function triBySportPlace($sport, $place)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i 
			JOIN i.sport s
			WHERE s.name LIKE :sport 
			AND i.accepted = false
			AND i.place LIKE :place 
			ORDER BY i.dateInvit ASC')
		->setParameter('sport', $sport)
		->setParameter('place', $place);

		return $query ->getResult();
	}

	public function triInvitsBySport($user, $sport)
	{
		$query = $this -> getEntitymanager() -> createQuery('
			SELECT i
			FROM FrontOfficeBundle:Invitation i
			JOIN i.sport s
			JOIN i.user u 
			WHERE i.accepted = false 
			AND u.id LIKE :id_user 
			AND s.id LIKE :id_sport
			ORDER BY i.dateInvit ASC')
		->setParameter('id_user', $user)
		->setParameter('id_sport', $sport);

		return $query -> getResult();
	}	
}
