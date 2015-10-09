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
     * @var integer
     *
     * @ORM\Column(name="scoreTeam1", type="integer", length=255, nullable = true)
     */
    private $scoreTeam1;

    /**
     * @var integer
     *
     * @ORM\Column(name="scoreTeam2", type="integer", length=255, nullable = true)
     */
    private $scoreTeam2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="played", type="boolean")
     */
    private $played;

    /**
     * @var boolean
     *
     * @ORM\Column(name="matchWinnedTeam1", type="boolean", nullable = true)
     */
    private $matchWinnedTeam1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="matchWinnedTeam2", type="boolean", nullable = true)
     */
    private $matchWinnedTeam2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="matchLostTeam1", type="boolean", nullable = true)
     */
    private $matchLostTeam1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="matchLostTeam2", type="boolean", nullable = true)
     */
    private $matchLostTeam2;

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
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", inversedBy="matche")
     *
     */
    private $players;    

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

    public function _toString()
    {
        return $this -> id;
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

    /**
     * Set partner
     *
     * @param \UserBundle\Entity\User $partner
     * @return Matche
     */
    public function setPartner(\UserBundle\Entity\User $partner = null)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * Get partner
     *
     * @return \UserBundle\Entity\User 
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * Set scoreTeam1
     *
     * @param integer $scoreTeam1
     * @return Matche
     */
    public function setScoreTeam1($scoreTeam1)
    {
        $this->scoreTeam1 = $scoreTeam1;

        return $this;
    }

    /**
     * Get scoreTeam1
     *
     * @return integer 
     */
    public function getScoreTeam1()
    {
        return $this->scoreTeam1;
    }

    /**
     * Set scoreTeam2
     *
     * @param integer $scoreTeam2
     * @return Matche
     */
    public function setScoreTeam2($scoreTeam2)
    {
        $this->scoreTeam2 = $scoreTeam2;

        return $this;
    }

    /**
     * Get scoreTeam2
     *
     * @return integer 
     */
    public function getScoreTeam2()
    {
        return $this->scoreTeam2;
    }

    /**
     * Set matchWinnedTeam1
     *
     * @param boolean $matchWinnedTeam1
     * @return Matche
     */
    public function setMatchWinnedTeam1($matchWinnedTeam1)
    {
        $this->matchWinnedTeam1 = $matchWinnedTeam1;

        return $this;
    }

    /**
     * Get matchWinnedTeam1
     *
     * @return boolean 
     */
    public function getMatchWinnedTeam1()
    {
        return $this->matchWinnedTeam1;
    }

    /**
     * Set matchWinnedTeam2
     *
     * @param boolean $matchWinnedTeam2
     * @return Matche
     */
    public function setMatchWinnedTeam2($matchWinnedTeam2)
    {
        $this->matchWinnedTeam2 = $matchWinnedTeam2;

        return $this;
    }

    /**
     * Get matchWinnedTeam2
     *
     * @return boolean 
     */
    public function getMatchWinnedTeam2()
    {
        return $this->matchWinnedTeam2;
    }

    /**
     * Set matchLostTeam1
     *
     * @param boolean $matchLostTeam1
     * @return Matche
     */
    public function setMatchLostTeam1($matchLostTeam1)
    {
        $this->matchLostTeam1 = $matchLostTeam1;

        return $this;
    }

    /**
     * Get matchLostTeam1
     *
     * @return boolean 
     */
    public function getMatchLostTeam1()
    {
        return $this->matchLostTeam1;
    }

    /**
     * Set matchLostTeam2
     *
     * @param boolean $matchLostTeam2
     * @return Matche
     */
    public function setMatchLostTeam2($matchLostTeam2)
    {
        $this->matchLostTeam2 = $matchLostTeam2;

        return $this;
    }

    /**
     * Get matchLostTeam2
     *
     * @return boolean 
     */
    public function getMatchLostTeam2()
    {
        return $this->matchLostTeam2;
    }

    /**
     * Add players
     *
     * @param \UserBundle\Entity\User $players
     * @return Matche
     */
    public function addPlayer(\UserBundle\Entity\User $players)
    {
        $this->players[] = $players;

        return $this;
    }

    /**
     * Remove players
     *
     * @param \UserBundle\Entity\User $players
     */
    public function removePlayer(\UserBundle\Entity\User $players)
    {
        $this->players->removeElement($players);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }
}
