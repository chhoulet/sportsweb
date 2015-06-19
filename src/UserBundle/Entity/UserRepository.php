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

	public function getAdminUser()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT u 
			FROM UserBundle:User u 
			WHERE u.validationAdmin = false');
		
		return $query -> getResult();
	}
}