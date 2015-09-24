<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Matche
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\MatcheRepository")
 */
class Matche
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
     *      min = "5",
     *      max = "50",
     *      minMessage = "La ville ne peut compter que {{ limit }} caractères",
     *      maxMessage = "La ville ne peut compter que {{ limit }} caractères"
     * )
     * @ORM\Column(name="place", type="string", length=255, nullable = true)
     */
    private $place;

    /**
     * @var \DateTime
     *    
     * @ORM\Column(name="dateplay", type="datetime")
     */
    private $dateplay;

    /**
     * @var string
     *
     * @ORM\Column(name="mode", type="string", length=255)
     */
    private $mode;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=255, nullable = true)
     */
    private $score;

    /**
     * @var boolean
     *
     * @ORM\Column(name="played", type="boolean")
     */
    private $played;

    /**
     * @var boolean
     *
     * @ORM\Column(name="matchWinned", type="boolean", nullable = true)
     */
    private $matchWinned;

    /**
     * @var boolean
     *
     * @ORM\Column(name="matchLost", type="boolean", nullable = true)
     */
    private $matchLost;

    /**
     * @var boolean
     *
     * @ORM\Column(name="matchNil", type="boolean", nullable = true)
     */
    private $matchNil;

    /**
     * @var boolean
     *
     * @ORM\Column(name="matchCancelled", type="boolean")
     */
    private $matchCancelled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="playedFuture", type="boolean")
     */
    private $playedFuture;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User", inversedBy="matche")
     */
    private $organizer;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Team", inversedBy="matche")
     * @ORM\JoinTable(name="match_teams")
     */
    private $team;   

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Tournament", inversedBy="matche")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id", nullable=true)
     */
    private $tournament;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Ground", inversedBy="matche")
     * @ORM\JoinColumn(name="ground_id", referencedColumnName="id", nullable=true)
     */
    private $ground;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="matche")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
     */
    private $sport;


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
     * Set place
     *
     * @param string $place
     * @return Matche
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
     * Set dateplay
     *
     * @param \DateTime $dateplay
     * @return Matche
     */
    public function setDateplay($dateplay)
    {
        $this->dateplay = $dateplay;

        return $this;
    }

    /**
     * Get dateplay
     *
     * @return \DateTime 
     */
    public function getDateplay()
    {
        return $this->dateplay;
    }

    /**
     * Set mode
     *
     * @param string $mode
     * @return Matche
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
     * Set score
     *
     * @param string $score
     * @return Matche
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set played
     *
     * @param boolean $played
     * @return Matche
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
     * @return Matche
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
     * @return Matche
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
     * Set tournament
     *
     * @param \FrontOfficeBundle\Entity\Tournament $tournament
     * @return Matche
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

    /**
     * Set ground
     *
     * @param \FrontOfficeBundle\Entity\Ground $ground
     * @return Matche
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
     * Set sport
     *
     * @param \FrontOfficeBundle\Entity\Sport $sport
     * @return Matche
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
     * Set matchWinned
     *
     * @param boolean $matchWinned
     * @return Matche
     */
    public function setMatchWinned($matchWinned)
    {
        $this->matchWinned = $matchWinned;

        return $this;
    }

    /**
     * Get matchWinned
     *
     * @return boolean 
     */
    public function getMatchWinned()
    {
        return $this->matchWinned;
    }

    /**
     * Set matchLost
     *
     * @param boolean $matchLost
     * @return Matche
     */
    public function setMatchLost($matchLost)
    {
        $this->matchLost = $matchLost;

        return $this;
    }

    /**
     * Get matchLost
     *
     * @return boolean 
     */
    public function getMatchLost()
    {
        return $this->matchLost;
    }

    /**
     * Set matchNil
     *
     * @param boolean $matchNil
     * @return Matche
     */
    public function setMatchNil($matchNil)
    {
        $this->matchNil = $matchNil;

        return $this;
    }

    /**
     * Get matchNil
     *
     * @return boolean 
     */
    public function getMatchNil()
    {
        return $this->matchNil;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add team
     *
     * @param \FrontOfficeBundle\Entity\Team $team
     * @return Matche
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
     * Set matchCancelled
     *
     * @param boolean $matchCancelled
     * @return Matche
     */
    public function setMatchCancelled($matchCancelled)
    {
        $this->matchCancelled = $matchCancelled;

        return $this;
    }

    /**
     * Get matchCancelled
     *
     * @return boolean 
     */
    public function getMatchCancelled()
    {
        return $this->matchCancelled;
    }
}
