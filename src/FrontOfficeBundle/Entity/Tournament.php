<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tournament
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\TournamentRepository")
 */
class Tournament
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
     * @Assert\Length(
     *      min = "2",
     *      max = "50",
     *      minMessage = "Le nom du tournoi doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom du tournoi ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "70",
     *      minMessage = "Le nom de la ville doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de la ville ne peut pas être plus long que {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     * @var integer
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "2",
     *      minMessage = "Le département ne peut compter que {{ limit }} caractères",
     *      maxMessage = "Le département ne peut compter que {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="postCode", type="integer")
     */
    private $postCode;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string")
     */
    private $region;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBegining", type="datetime", nullable = true)
     */
    private $dateBegining;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnding", type="datetime", nullable = true)
     */
    private $dateEnding;   

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "5",
     *      max = "500",
     *      minMessage = "Le département ne peut compter que {{ limit }} caractères",
     *      maxMessage = "Le département ne peut compter que {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;    

    /**
     * @var boolean     
     *
     * @ORM\Column(name="current", type="boolean")
     */
    private $current;

    /**
     * @var boolean
     *
     * @ORM\Column(name="played", type="boolean")
     */
    private $played;

    /**
     * @var boolean
     *
     * @ORM\Column(name="playedFuture", type="boolean")
     */
    private $playedFuture;

    /**
     * @var boolean
     *
     * @ORM\Column(name="privat", type="boolean")
     */
    private $privat;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Matche", mappedBy="tournament")
     */
    private $matche;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="tournament")
     * @ORM\JoinColumn(name="organizer_id", referencedColumnName="id")
     */
    private $organizer;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="tournament")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
     */
    private $sport;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Team", inversedBy="tournament")
     * @ORM\JoinTable(name="tournament_teams")
     */
    private $teams;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="tournament")
     */
    private $invitation;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Comment", mappedBy="tournament")
     */
    private $comment;


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
     * @return Tournament
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
     * Set place
     *
     * @param string $place
     * @return Tournament
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }    
    
    /**
     * Set dateBegining
     *
     * @param \DateTime $dateBegining
     * @return Tournament
     */
    public function setDateBegining($dateBegining)
    {
        $this->dateBegining = $dateBegining;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get dateBegining
     *
     * @return \DateTime 
     */
    public function getDateBegining()
    {
        return $this->dateBegining;
    }

    /**
     * Set dateEnding
     *
     * @param \DateTime $dateEnding
     * @return Tournament
     */
    public function setDateEnding($dateEnding)
    {
        $this->dateEnding = $dateEnding;

        return $this;
    }

    /**
     * Get dateEnding
     *
     * @return \DateTime 
     */
    public function getDateEnding()
    {
        return $this->dateEnding;
    }


    /**
     * Set description
     *
     * @param string $description
     * @return Tournament
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->matche = new \Doctrine\Common\Collections\ArrayCollection();
        $this -> setDateCreated(new \DateTime('now'));
    }

    /**
     * Add matche
     *
     * @param \FrontOfficeBundle\Entity\Matche $matche
     * @return Tournament
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
     * Set current
     *
     * @param boolean $current
     * @return Tournament
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current
     *
     * @return boolean 
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Set played
     *
     * @param boolean $played
     * @return Tournament
     */
    public function setPlayed($played)
    {
        $this->played = $played;

        return $this;
    }

    /**
     * Get played
     *
     * @return boolean 
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * Set playedFuture
     *
     * @param boolean $playedFuture
     * @return Tournament
     */
    public function setPlayedFuture($playedFuture)
    {
        $this->playedFuture = $playedFuture;

        return $this;
    }

    /**
     * Get playedFuture
     *
     * @return boolean 
     */
    public function getPlayedFuture()
    {
        return $this->playedFuture;
    }

    /**
     * Set organizer
     *
     * @param \UserBundle\Entity\User $organizer
     * @return Tournament
     */
    public function setOrganizer(\UserBundle\Entity\User $organizer = null)
    {
        $this->organizer = $organizer;

        return $this;
    }

    /**
     * Get organizer
     *
     * @return \UserBundle\Entity\User 
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * Set sport
     *
     * @param \FrontOfficeBundle\Entity\Sport $sport
     * @return Tournament
     */
    public function setSport(\FrontOfficeBundle\Entity\Sport $sport = null)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return \FrontOfficeBundle\Entity\Sport 
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Add teams
     *
     * @param \FrontOfficeBundle\Entity\Team $teams
     * @return Tournament
     */
    public function addTeam(\FrontOfficeBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;

        return $this;
    }

    /**
     * Remove teams
     *
     * @param \FrontOfficeBundle\Entity\Team $teams
     */
    public function removeTeam(\FrontOfficeBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Add invitation
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitation
     * @return Tournament
     */
    public function addInvitation(\FrontOfficeBundle\Entity\Invitation $invitation)
    {
        $this->invitation[] = $invitation;

        return $this;
    }

    /**
     * Remove invitation
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitation
     */
    public function removeInvitation(\FrontOfficeBundle\Entity\Invitation $invitation)
    {
        $this->invitation->removeElement($invitation);
    }

    /**
     * Get invitation
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitation()
    {
        return $this->invitation;
    }

    /**
     * Set postCode
     *
     * @param integer $postCode
     * @return Tournament
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return integer 
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Tournament
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
     * Add comment
     *
     * @param \FrontOfficeBundle\Entity\Comment $comment
     * @return Tournament
     */
    public function addComment(\FrontOfficeBundle\Entity\Comment $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \FrontOfficeBundle\Entity\Comment $comment
     */
    public function removeComment(\FrontOfficeBundle\Entity\Comment $comment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Tournament
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set privat
     *
     * @param boolean $privat
     * @return Tournament
     */
    public function setPrivat($privat)
    {
        $this->privat = $privat;

        return $this;
    }

    /**
     * Get privat
     *
     * @return boolean 
     */
    public function getPrivat()
    {
        return $this->privat;
    }
}
