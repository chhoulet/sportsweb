<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TeamRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TeamRepository extends EntityRepository
{	
	#Query selectionnant les team non valides par l'admin:
	public function getTeamUnvalidated()
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT t 
			FROM FrontOfficeBundle:Team t 
			WHERE t.validationAdmin = false
			AND t.active = true');

		return $query -> getResult();
	}

	public function getLastCreatedTeams()
	{
		//WHERE t.place LIKE :place
		//->setParameter('place', '%aris%')
		$query = $this -> getEntityManager()-> createQuery('
			SELECT t 
			FROM FrontOfficeBundle:Team t 
			WHERE t.active = true
			ORDER BY t.dateCreated DESC')
		
		->setMaxResults(20);

		return $query -> getResult();
	}

	public function nbTeams()
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT COUNT(t.id) 
			FROM FrontOfficeBundle:Team t
			WHERE t.active = true');

		return $query -> getSingleScalarResult();
	}

	public function getTeamsBySport($sportPracticed)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT t
			FROM FrontOfficeBundle:Team t
			JOIN t.sportPracticed s 
			WHERE s.name LIKE :sportPracticed
			AND t.active = true')
		->setParameter('sportPracticed', $sportPracticed)
		->setMaxResults(30);

		return $query -> getResult();
	}

	public function getTeamsByGroundAndSport($ground, $sportPracticed)
	{
		$query = $this -> getEntitymanager()->createQuery('
			SELECT t 
			FROM FrontOfficeBundle:Team t 
			JOIN t.sportPracticed s 
			JOIN t.groung g 
			WHERE s.name LIKE :sportPracticed
			AND t.active = true
			AND g.name LIKE :ground
			AND g.validAdmin = true
			ORDER BY t.dateCreated DESC')
		-> setParameter('sportPracticed', $sportPracticed)
		-> setParameter('ground', $ground);

		return $query->getResult();
	}

	public function getTeamsByInvitationsSent()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT t.name ,COUNT(i.id) AS nb
			FROM FrontOfficeBundle:Team t
			JOIN t.invitationsSentFromTeam i
			WHERE i.accepted = true
			GROUP BY t.name
			ORDER BY nb DESC
			');

		return $query -> getResult();
	}

	public function getTeamsByInvitationsReceived()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT t.name ,COUNT(i.id) AS nb
			FROM FrontOfficeBundle:Team t
			JOIN t.invitationsReceivedToTeam i
			WHERE i.accepted = true
			GROUP BY t.name
			ORDER BY nb DESC
			');

		return $query -> getResult();
	}

	public function getUnactiveTeams()
	{
		$query = $this -> getEntitymanager()->createQuery('
			SELECT t 
			FROM FrontOfficeBundle:Team t 
			WHERE t.active = false');

		return $query -> getResult();
	}

	public function getWinnersTeams()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT t.name, COUNT(m.id) AS nb 
			FROM FrontOfficeBundle:Team t 
			JOIN t.matche m		
			WHERE m.matchWinned = true 
			GROUP BY t.name')
		->setMaxResults(25);

		return $query -> getResult();
	}

}


































