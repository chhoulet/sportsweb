<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SportRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SportRepository extends EntityRepository
{
	public function getSportsByInvitsNumber()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT s.name, COUNT(i.id) as nb
			FROM FrontOfficeBundle:Sport s
			JOIN s.invitations i
			GROUP BY s.id
			');

		return $query -> getResult();
	}

	public function getSportsByUsers()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT s.name, COUNT(u.id) as nb
			FROM FrontOfficeBundle:Sport s
			JOIN s.userSport u
			GROUP BY u.id');

		return $query -> getResult();
	}

	public function getSportsByGround()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT s.name, COUNT(g.id) as nb
			FROM FrontOfficeBundle:Sport s 
			JOIN s.ground g 
			GROUP BY g.id');

		return $query -> getResult();
	}

	public function triSportsByTeam()
	{
		$query = $this->getEntityManager()->createQuery('
			SELECT s.name, COUNT(t.id) as nb
			FROM FrontOfficeBundle:Sport s 
			JOIN s.team t 
			GROUP BY t.id');

		return $query -> getResult();
	}

	public function getNbInvitsBySport()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT s.name, COUNT(i.id) AS nb
			FROM FrontOfficeBundle:Sport s 
			JOIN s.invitations i
			GROUP BY s.name
			ORDER BY nb DESC');

		return $query -> getResult();
	}
}