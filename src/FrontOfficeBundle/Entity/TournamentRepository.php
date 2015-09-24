<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TournamentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TournamentRepository extends EntityRepository
{
	public function getTournaments()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT t 
			FROM FrontOfficeBundle:Tournament t
			WHERE t.played = false 
			ORDER BY t.dateCreated DESC')
		->setMaxResults(8);

		return $query -> getResult();		
	}

	public function nbTournaments()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT COUNT(t.id)
			FROM FrontOfficeBundle:Tournament t');

		return $query -> getSingleScalarResult();
	}

	public function getTournamentsByRegion()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT t.region, COUNT(t.id) AS nb 
			FROM FrontOfficeBundle:Tournament t
			GROUP BY t.region 
			ORDER BY nb DESC');

		return $query ->getResult();
	}

	public function getTournamentsByPostCode()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT t.postCode, COUNT(t.id) AS nb
			FROM FrontOfficeBundle:Tournament t 
			GROUP BY t.postCode
			ORDER BY nb DESC');

		return $query -> getResult();
	}

	public function getTournamentsByPlace()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT t.place, COUNT(t.id) AS nb
			FROM FrontOfficeBundle:Tournament t 
			GROUP BY t.place 
			ORDER BY nb DESC');

		return $query -> getResult();
	}
}
