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
	# Query sélectionnant les 50 dernières invitations:
	public function getInvitation()
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i 
			WHERE i.accepted = false
			ORDER BY i.dateCreated DESC')
		->setMaxResults(50);

		return $query -> getResult();
	}

	# Query permettant un tri des invitations par sport:
	public function sportInvitation($sport)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i 
			WHERE i.accepted = false 
			AND i.sport LIKE :sport')
		->setParameter('sport', $sport);

		return $query ->getResult();
	}

	# Query affichant les invitations acceptées par un player:
	public function seeInvitation($player)
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i 
			JOIN i.player j 
			WHERE i.accepted = true 
			AND j.username LIKE :player')
		->setParameter('player', $player);

		return $query -> getResult();
	}

	# invitations par sport :
	public function invitFoot()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i 
			WHERE i.sport LIKE :foot
			AND i.accepted = false')
		->setParameter('foot','football');

		return $query -> getResult();
	}

	public function invitBasket()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT i 
			FROM FrontOfficeBundle:Invitation i 
			WHERE i.sport LIKE :bask
			AND i.accepted = false')
		->setParameter('bask','basket');

		return $query -> getResult();
	}

	public function nbInvitations()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT COUNT(i.id) 
			FROM FrontOfficeBundle:Invitation i');

		return $query -> getSingleScalarResult();
	}

	public function nbInvitationsAccepted()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT COUNT(i.id) 
			FROM FrontOfficeBundle:Invitation i
			WHERE i.accepted = true');

		return $query -> getSingleScalarResult();
	}

	public function nbInvitationsDenied()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT COUNT(i.id) 
			FROM FrontOfficeBundle:Invitation i
			WHERE i.accepted = false');

		return $query -> getSingleScalarResult();
	}
}
