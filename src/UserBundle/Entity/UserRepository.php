<?php

namespace UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
	public function nbUsers()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT COUNT(u.id)
			FROM UserBundle:User u');

		return $query -> getSingleScalarResult();
	}

	/*Selection des users non valides par admin:*/
	public function getAdminUser()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT u 
			FROM UserBundle:User u 
			WHERE u.validationAdmin = false
			AND u.userWarned = false');
		
		return $query -> getResult();
	}

	public function getWarnedUsers()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT u 
			FROM UserBundle:User u 
			WHERE u.userWarned = true
			');
		
		return $query -> getResult();
	}

	public function showNewUsers()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT u 
			FROM UserBundle:User u 
			ORDER BY  u.dateCreated DESC')
		->setMaxResults(50);

		return $query -> getResult();
	}

	public function getNbArticlesByUsers()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT u.username, COUNT(a.id) as nb
			FROM UserBundle:User u
			JOIN u.article a 
			ORDER BY u.id DESC')
		->setMaxResults(5);

		return $query -> getResult();
	}
}