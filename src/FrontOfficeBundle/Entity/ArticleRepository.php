<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
	public function getArticle()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT a 
			FROM FrontOfficeBundle:Article a 
			WHERE a.validationAdmin = true
			ORDER BY a.dateCreated DESC')
		->setMaxResults(6);

		return $query -> getResult();
	}

	public function triArticle($category)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT a 
			FROM FrontOfficeBundle:Article a 
			WHERE a.category LIKE :category')
		->setParameter('category',  $category);

		return $query ->getResult();
	}

	public function validArticle()
	{
		$query = $this -> getEntitymanager()->createQuery('
			SELECT a 
			FROM FrontOfficeBundle:Article a 
			WHERE a.validationAdmin = false
			AND a.warned = false
			ORDER BY a.dateCreated DESC');

		return $query -> getResult();
	}

	public function nbArticles()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT COUNT(a.id)
			FROM FrontOfficeBundle:Article a');

		return $query ->getSingleScalarResult();
	}
}
