<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Invitation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\InvitationRepository")
 */
class Invitation
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
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "10",
     *      max = "250",
     *      minMessage = "Votre invitation doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre invitation ne peut pas être plus longue que {{ limit }} caractères"
     * )
     * @ORM\Column(name="content", type="string", length=450)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateInvit", type="datetime")
     */
    private $dateInvit;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="invitation")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="invitations")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
     */
    private $sport;

    /**
     * @var string
     *
     * @ORM\Column(name="mode", type="string", length=255)
     */
    private $mode; 

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region; 

    /**
     * @var string
     *
     * @ORM\Column(name="postCode", type="string", length=255)
     */
    private $postCode;    

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="invitationsSent")
     * @ORM\JoinColumn(name="user_from_id", referencedColumnName="id")
     */
    private $userFrom;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="invitationsReceived")
     * @ORM\JoinColumn(name="user_to_id", referencedColumnName="id", nullable=true)
     */
    private $userTo;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Team", inversedBy="invitationsSentFromTeam")
     * @ORM\JoinColumn(name="team_from_id", referencedColumnName="id", nullable=true)
     */
    private $teamFrom;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Team", inversedBy="invitationsReceivedToTeam")
     * @ORM\JoinColumn(name="team_to_id", referencedColumnName="id", nullable=true)
     */
    private $teamTo;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Le nom de la région doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de la région ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="accepted", type="boolean")
     */
    private $accepted;

    /**
     * @var boolean
     *
     * @ORM\Column(name="denied", type="boolean")
     */
    private $denied;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateDenied", type="datetime", nullable=true)
     */
    private $dateDenied;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateAccepted", type="datetime", nullable=true)
     */
    private $dateAccepted;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Ground", inversedBy="invitation")
     * @ORM\JoinColumn(name="ground_id", referencedColumnName="id", nullable=true)
     */
    private $ground;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Tournament", inversedBy="invitation")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id", nullable=true)
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
     * Set content
     *
     * @param string $content
     * @return Invitation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateInvit
     *
     * @param \DateTime $dateInvit
     * @return Invitation
     */
    public function setDateInvit($dateInvit)
    {
        $this->dateInvit = $dateInvit;

        return $this;
    }

    /**
     * Get dateInvit
     *
     * @return \DateTime 
     */
    public function getDateInvit()
    {
        return $this->dateInvit;
    }

    /**
     * Set sport
     *
     * @param string $sport
     * @return Invitation
     */
    public function setSport($sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return string 
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Invitation
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Invitation
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
     * Set accepted
     *
     * @param boolean $accepted
     * @return Invitation
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * Get accepted
     *
     * @return boolean 
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set dateAccepted
     *
     * @param \DateTime $dateAccepted
     * @return Invitation
     */
    public function setDateAccepted($dateAccepted)
    {
        $this->dateAccepted = $dateAccepted;

        return $this;
    }

    /**
     * Get dateAccepted
     *
     * @return \DateTime 
     */
    public function getDateAccepted()
    {
        return $this->dateAccepted;
    }

    /**
     * Set ground
     *
     * @param \FrontOfficeBundle\Entity\Ground $ground
     * @return Invitation
     */
    public function setGround(\FrontOfficeBundle\Entity\Ground $ground = null)
    {
        $this->ground = $ground;

        return $this;
    }

    /**
     * Get ground
     *
     * @return \FrontOfficeBundle\Entity\Ground 
     */
    public function getGround()
    {
        return $this->ground;
    }

    /**
     * Set mode
     *
     * @param string $mode
     * @return Invitation
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Get mode
     *
     * @return string 
     */
    public function getMode()
    {
        return $this->mode;
    }   
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invitation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set userFrom
     *
     * @param \UserBundle\Entity\User $userFrom
     * @return Invitation
     */
    public function setUserFrom(\UserBundle\Entity\User $userFrom = null)
    {
        $this->userFrom = $userFrom;

        return $this;
    }

    /**
     * Get userFrom
     *
     * @return \UserBundle\Entity\User 
     */
    public function getUserFrom()
    {
        return $this->userFrom;
    }

    /**
     * Set userTo
     *
     * @param \UserBundle\Entity\User $userTo
     * @return Invitation
     */
    public function setUserTo(\UserBundle\Entity\User $userTo = null)
    {
        $this->userTo = $userTo;

        return $this;
    }

    /**
     * Get userTo
     *
     * @return \UserBundle\Entity\User 
     */
    public function getUserTo()
    {
        return $this->userTo;
    }

    /**
     * Set denied
     *
     * @param boolean $denied
     * @return Invitation
     */
    public function setDenied($denied)
    {
        $this->denied = $denied;

        return $this;
    }

    /**
     * Get denied
     *
     * @return boolean 
     */
    public function getDenied()
    {
        return $this->denied;
    }

    /**
     * Set dateDenied
     *
     * @param \DateTime $dateDenied
     * @return Invitation
     */
    public function setDateDenied($dateDenied)
    {
        $this->dateDenied = $dateDenied;

        return $this;
    }

    /**
     * Get dateDenied
     *
     * @return \DateTime 
     */
    public function getDateDenied()
    {
        return $this->dateDenied;
    }

    /**
     * Set teamFrom
     *
     * @param \FrontOfficeBundle\Entity\Team $teamFrom
     * @return Invitation
     */
    public function setTeamFrom(\FrontOfficeBundle\Entity\Team $teamFrom = null)
    {
        $this->teamFrom = $teamFrom;

        return $this;
    }

    /**
     * Get teamFrom
     *
     * @return \FrontOfficeBundle\Entity\Team 
     */
    public function getTeamFrom()
    {
        return $this->teamFrom;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return Invitation
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set teamTo
     *
     * @param \FrontOfficeBundle\Entity\Team $teamTo
     * @return Invitation
     */
    public function setTeamTo(\FrontOfficeBundle\Entity\Team $teamTo = null)
    {
        $this->teamTo = $teamTo;

        return $this;
    }

    /**
     * Get teamTo
     *
     * @return \FrontOfficeBundle\Entity\Team 
     */
    public function getTeamTo()
    {
        return $this->teamTo;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Invitation
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
     * Set postCode
     *
     * @param string $postCode
     * @return Invitation
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string 
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set tournament
     *
     * @param \FrontOfficeBundle\Entity\Tournament $tournament
     * @return Invitation
     */
    public function setTournament(\FrontOfficeBundle\Entity\Tournament $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \FrontOfficeBundle\Entity\Tournament 
     */
    public function getTournament()
    {
        return $this->tournament;
    }
}
