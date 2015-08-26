<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{
	# Selection des commentaires non validés par l'admin
	public function getUnvalidatedCommentTeam()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT c 
			FROM FrontOfficeBundle:Comment c 
			WHERE c.validationAdmin = false
			AND c.teamComment = true 
			AND c.articleComment = false
			AND c.groundComment = false
			AND c.censored = false
			ORDER BY c.dateCreated DESC');

		return $query -> getResult();
	}

	public function getUnvalidatedCommentArticle()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT c 
			FROM FrontOfficeBundle:Comment c 
			WHERE c.validationAdmin = false
			AND c.teamComment = false 
			AND c.articleComment = true
			AND c.groundComment = false
			AND c.censored = false
			ORDER BY c.dateCreated DESC');

		return $query -> getResult();
	}

	public function getUnvalidatedCommentGround()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT c 
			FROM FrontOfficeBundle:Comment c 
			WHERE c.validationAdmin = false
			AND c.teamComment = false
			AND c.articleComment = false
			AND c.groundComment = true
			AND c.censored = false
			ORDER BY c.dateCreated DESC');

		return $query -> getResult();
	}

	# Comptage des comments postes 
	public function nbComments()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT COUNT(c.id)
			FROM FrontOfficeBundle:Comment c');

		return $query -> getSingleScalarResult();
	}

	# Affichage du 1er commentaire d'un article:
	public function getFirstComment()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT c 
			FROM FrontOfficeBundle:Comment c
			ORDER BY c.dateCreated DESC')
		->setMaxResult(1);

		return $query -> getSingleResult();
	}

	public function getCommentsCensored()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT c 
			FROM FrontOfficeBundle:Comment c 
			WHERE c.setValidationAdmin = false 
			AND c.censored = true 
			ORDER BY c.dateCreated DESC');

		return $query -> getResult();
	}

	public function getCommentsGroundsCensored()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT c 
			FROM FrontOfficeBundle:Comment c 
			WHERE c.validationAdmin = false 
			AND c.censored = true 
			AND c.teamComment = false
			AND c.articleComment = false
			AND c.groundComment = true
			ORDER BY c.dateCreated DESC');

		return $query -> getResult();
	}

	public function getCommentsTeamsCensored()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT c 
			FROM FrontOfficeBundle:Comment c 
			WHERE c.validationAdmin = false 
			AND c.censored = true 
			AND c.teamComment = true
			AND c.articleComment = false
			AND c.groundComment = false
			ORDER BY c.dateCreated DESC');

		return $query -> getResult();
	}

	public function getCommentsArticlesCensored()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT c 
			FROM FrontOfficeBundle:Comment c 
			WHERE c.validationAdmin = false 
			AND c.censored = true 
			AND c.teamComment = false
			AND c.articleComment = true
			AND c.groundComment = false
			ORDER BY c.dateCreated DESC');

		return $query -> getResult();
	}
}
