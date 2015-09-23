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
     * @ORM\OneToOne(targetEntity="FrontOfficeBundle\Entity\Team", inversedBy="matche1")
     * @ORM\JoinColumn(name="team1_id", referencedColumnName="id", nullable = true)
     */
    private $team1;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="FrontOfficeBundle\Entity\Team", inversedBy="matche2")
     * @ORM\JoinColumn(name="team2_id", referencedColumnName="id", nullable = true)
     */
    private $team2;

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
     * Set team1
     *
     * @param \FrontOfficeBundle\Entity\Team $team1
     * @return Matche
     */
    public function setTeam1(\FrontOfficeBundle\Entity\Team $team1 = null)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1
     *
     * @return \FrontOfficeBundle\Entity\Team 
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2
     *
     * @param \FrontOfficeBundle\Entity\Team $team2
     * @return Matche
     */
    public function setTeam2(\FrontOfficeBundle\Entity\Team $team2 = null)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2
     *
     * @return \FrontOfficeBundle\Entity\Team 
     */
    public function getTeam2()
    {
        return $this->team2;
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
}
