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

	public function getNbCommentsByUsers()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT u.username, COUNT(c.id) as nb
			FROM UserBundle:User u
			JOIN u.comment c 
			WHERE c.validationAdmin = true 
			GROUP BY u.username
			ORDER BY nb DESC')
		->setMaxResults(15);

		return $query -> getResult();
	}

	public function getNbInvitsByUser()
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT u.username, COUNT(i.id) AS nb
			FROM UserBundle:User u 
			JOIN u.invitationsSent i
			GROUP By u.username
			ORDER BY nb DESC ')
		->setMaxResults(25);

		return $query -> getResult();
	}

	public function getNbInvitsReceivedByUser()
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT u.username, COUNT(i.id) AS nb
			FROM UserBundle:User u 
			JOIN u.invitationsReceived i
			GROUP By u.username
			ORDER BY nb DESC ')
		->setMaxResults(25);

		return $query -> getResult();
	}

	public function getNbArticlesByUsers()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT u.username, COUNT(a.id) as nb
			FROM UserBundle:User u
			JOIN u.article a  
			WHERE a.validationAdmin = true
			GROUP BY u.username
			ORDER BY nb DESC')
		->setMaxResults(15);

		return $query -> getResult();
	}
}