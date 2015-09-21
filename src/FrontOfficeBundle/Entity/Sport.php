<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\SportRepository")
 */
class Sport
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="sportPracticed")
     */
    private $practicedUsers;
   
    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="sportViewed")
     */
    private $viewedUsers;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="sport")
     */
    private $invitations;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Ground", mappedBy="sport")
     */
    private $ground;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Article", mappedBy="sport")
     */
    private $articles;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="favouriteSport")
     */
    private $userSport;

     /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Team", mappedBy="sportPracticed")
     */
    private $team;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Matche", mappedBy="sport")
     */
    private $matche;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Tournament", mappedBy="sport")
     */
    private $tournament;
   
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Sport
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Add practicedUsers
     *
     * @param \UserBundle\Entity\User $practicedUsers
     * @return Sport
     */
    public function addPracticedUser(\UserBundle\Entity\User $practicedUsers)
    {
        $this->practicedUsers[] = $practicedUsers;

        return $this;
    }

    /**
     * Remove practicedUsers
     *
     * @param \UserBundle\Entity\User $practicedUsers
     */
    public function removePracticedUser(\UserBundle\Entity\User $practicedUsers)
    {
        $this->practicedUsers->removeElement($practicedUsers);
    }

    /**
     * Get practicedUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPracticedUsers()
    {
        return $this->practicedUsers;
    }

    /**
     * Add viewedUsers
     *
     * @param \UserBundle\Entity\User $viewedUsers
     * @return Sport
     */
    public function addViewedUser(\UserBundle\Entity\User $viewedUsers)
    {
        $this->viewedUsers[] = $viewedUsers;

        return $this;
    }

    /**
     * Remove viewedUsers
     *
     * @param \UserBundle\Entity\User $viewedUsers
     */
    public function removeViewedUser(\UserBundle\Entity\User $viewedUsers)
    {
        $this->viewedUsers->removeElement($viewedUsers);
    }

    /**
     * Get viewedUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getViewedUsers()
    {
        return $this->viewedUsers;
    }

    public function __toString()
    {
        return $this -> name;
    }

    /**
     * Add invitations
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitations
     * @return Sport
     */
    public function addInvitation(\FrontOfficeBundle\Entity\Invitation $invitations)
    {
        $this->invitations[] = $invitations;

        return $this;
    }

    /**
     * Remove invitations
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitations
     */
    public function removeInvitation(\FrontOfficeBundle\Entity\Invitation $invitations)
    {
        $this->invitations->removeElement($invitations);
    }

    /**
     * Get invitations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitations()
    {
        return $this->invitations;
    }

   

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Sport
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Add ground
     *
     * @param \FrontOfficeBundle\Entity\Ground $ground
     * @return Sport
     */
    public function addGround(\FrontOfficeBundle\Entity\Ground $ground)
    {
        $this->ground[] = $ground;

        return $this;
    }

    /**
     * Remove ground
     *
     * @param \FrontOfficeBundle\Entity\Ground $ground
     */
    public function removeGround(\FrontOfficeBundle\Entity\Ground $ground)
    {
        $this->ground->removeElement($ground);
    }

    /**
     * Get ground
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGround()
    {
        return $this->ground;
    }

    /**
     * Add articles
     *
     * @param \FrontOfficeBundle\Entity\Article $articles
     * @return Sport
     */
    public function addArticle(\FrontOfficeBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \FrontOfficeBundle\Entity\Article $articles
     */
    public function removeArticle(\FrontOfficeBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add userSport
     *
     * @param \UserBundle\Entity\User $userSport
     * @return Sport
     */
    public function addUserSport(\UserBundle\Entity\User $userSport)
    {
        $this->userSport[] = $userSport;

        return $this;
    }

    /**
     * Remove userSport
     *
     * @param \UserBundle\Entity\User $userSport
     */
    public function removeUserSport(\UserBundle\Entity\User $userSport)
    {
        $this->userSport->removeElement($userSport);
    }

    /**
     * Get userSport
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserSport()
    {
        return $this->userSport;
    }

    /**
     * Add team
     *
     * @param \FrontOfficeBundle\Entity\Team $team
     * @return Sport
     */
    public function addTeam(\FrontOfficeBundle\Entity\Team $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \FrontOfficeBundle\Entity\Team $team
     */
    public function removeTeam(\FrontOfficeBundle\Entity\Team $team)
    {
        $this->team->removeElement($team);
    }

    /**
     * Get team
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Add matche
     *
     * @param \FrontOfficeBundle\Entity\Matche $matche
     * @return Sport
     */
    public function addMatche(\FrontOfficeBundle\Entity\Matche $matche)
    {
        $this->matche[] = $matche;

        return $this;
    }

    /**
     * Remove matche
     *
     * @param \FrontOfficeBundle\Entity\Matche $matche
     */
    public function removeMatche(\FrontOfficeBundle\Entity\Matche $matche)
    {
        $this->matche->removeElement($matche);
    }

    /**
     * Get matche
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatche()
    {
        return $this->matche;
    }

    /**
     * Add tournament
     *
     * @param \FrontOfficeBundle\Entity\Tournament $tournament
     * @return Sport
     */
    public function addTournament(\FrontOfficeBundle\Entity\Tournament $tournament)
    {
        $this->tournament[] = $tournament;

        return $this;
    }

    /**
     * Remove tournament
     *
     * @param \FrontOfficeBundle\Entity\Tournament $tournament
     */
    public function removeTournament(\FrontOfficeBundle\Entity\Tournament $tournament)
    {
        $this->tournament->removeElement($tournament);
    }

    /**
     * Get tournament
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTournament()
    {
        return $this->tournament;
    }
}
