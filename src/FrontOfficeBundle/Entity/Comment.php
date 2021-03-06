<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\CommentRepository")
 */
class Comment
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
     * @Assert\Length(
     *      min = "0",
     *      max = "100",
     *      minMessage = "Votre titre doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre titre ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="title", type="string", length=100)
     */     
    private $title;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "5",
     *      max = "500",
     *      minMessage = "Votre commentaire doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre commentaire ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="content", type="text")
    */
     
    private $content;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "5",
     *      max = "50",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="comment")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

     /**
     * @var boolean
     *
     *
     * @ORM\Column(name="validationAdmin", type="boolean")
     */
    private $validationAdmin;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateValidated", type="date", nullable = true)
     */
    private $dateValidated;

    /**
     * @var boolean
     *
     *
     * @ORM\Column(name="teamComment", type="boolean")
     */
    private $teamComment;

    /**
     * @var boolean
     *
     *
     * @ORM\Column(name="tournamentComment", type="boolean")
     */
    private $tournamentComment;

    /**
     * @var boolean
     *
     *
     * @ORM\Column(name="censored", type="boolean")
     */
    private $censored;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateCensored", type="date", nullable = true)
     */
    private $dateCensored;

    /**
     * @var boolean
     *
     *
     * @ORM\Column(name="articleComment", type="boolean")
     */
    private $articleComment;

    /**
     * @var boolean
     *
     *
     * @ORM\Column(name="groundComment", type="boolean")
     */
    private $groundComment;

    /**
     * @var boolean
     *
     * @ORM\Column(name="matcheComment", type="boolean")
     */
    private $matcheComment;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Article", inversedBy="comment")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Ground", inversedBy="com")
     * @ORM\JoinColumn(name="ground_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $ground;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Team", inversedBy="comment")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $team;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Tournament", inversedBy="comment")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $tournament;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Matche", inversedBy="comment")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $matche;


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
     * Set title
     *
     * @param string $title
     * @return Comment
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Comment
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
     * Set content
     *
     * @param string $content
     * @return Comment
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
     * Set author
     *
     * @param string $author
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set article
     *
     * @param \FrontOfficeBundle\Entity\Article $article
     * @return Comment
     */
    public function setArticle(\FrontOfficeBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \FrontOfficeBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set validationAdmin
     *
     * @param boolean $validationAdmin
     * @return Comment
     */
    public function setValidationAdmin($validationAdmin)
    {
        $this->validationAdmin = $validationAdmin;

        return $this;
    }

    /**
     * Get validationAdmin
     *
     * @return boolean 
     */
    public function getValidationAdmin()
    {
        return $this->validationAdmin;
    }

    /**
     * Set dateValidated
     *
     * @param \DateTime $dateValidated
     * @return Comment
     */
    public function setDateValidated($dateValidated)
    {
        $this->dateValidated = $dateValidated;

        return $this;
    }

    /**
     * Get dateValidated
     *
     * @return \DateTime 
     */
    public function getDateValidated()
    {
        return $this->dateValidated;
    }

    /**
     * Set ground
     *
     * @param \FrontOfficeBundle\Entity\Ground $ground
     * @return Comment
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
     * Set team
     *
     * @param \FrontOfficeBundle\Entity\Team $team
     * @return Comment
     */
    public function setTeam(\FrontOfficeBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \FrontOfficeBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set teamComment
     *
     * @param boolean $teamComment
     * @return Comment
     */
    public function setTeamComment($teamComment)
    {
        $this->teamComment = $teamComment;

        return $this;
    }

    /**
     * Get teamComment
     *
     * @return boolean 
     */
    public function getTeamComment()
    {
        return $this->teamComment;
    }

    /**
     * Set articleComment
     *
     * @param boolean $articleComment
     * @return Comment
     */
    public function setArticleComment($articleComment)
    {
        $this->articleComment = $articleComment;

        return $this;
    }

    /**
     * Get articleComment
     *
     * @return boolean 
     */
    public function getArticleComment()
    {
        return $this->articleComment;
    }

    /**
     * Set groundComment
     *
     * @param boolean $groundComment
     * @return Comment
     */
    public function setGroundComment($groundComment)
    {
        $this->groundComment = $groundComment;

        return $this;
    }

    /**
     * Get groundComment
     *
     * @return boolean 
     */
    public function getGroundComment()
    {
        return $this->groundComment;
    }

    /**
     * Set censored
     *
     * @param boolean $censored
     * @return Comment
     */
    public function setCensored($censored)
    {
        $this->censored = $censored;

        return $this;
    }

    /**
     * Get censored
     *
     * @return boolean 
     */
    public function getCensored()
    {
        return $this->censored;
    }

    /**
     * Set dateCensored
     *
     * @param \DateTime $dateCensored
     * @return Comment
     */
    public function setDateCensored($dateCensored)
    {
        $this->dateCensored = $dateCensored;

        return $this;
    }

    /**
     * Get dateCensored
     *
     * @return \DateTime 
     */
    public function getDateCensored()
    {
        return $this->dateCensored;
    }

    /**
     * Set tournament
     *
     * @param \FrontOfficeBundle\Entity\Tournament $tournament
     * @return Comment
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
     * Set tournamentComment
     *
     * @param boolean $tournamentComment
     * @return Comment
     */
    public function setTournamentComment($tournamentComment)
    {
        $this->tournamentComment = $tournamentComment;

        return $this;
    }

    /**
     * Get tournamentComment
     *
     * @return boolean 
     */
    public function getTournamentComment()
    {
        return $this->tournamentComment;
    }

    /**
     * Set matche
     *
     * @param \FrontOfficeBundle\Entity\Matche $matche
     * @return Comment
     */
    public function setMatche(\FrontOfficeBundle\Entity\Matche $matche = null)
    {
        $this->matche = $matche;

        return $this;
    }

    /**
     * Get matche
     *
     * @return \FrontOfficeBundle\Entity\Matche 
     */
    public function getMatche()
    {
        return $this->matche;
    }

    /**
     * Set matcheComment
     *
     * @param boolean $matcheComment
     * @return Comment
     */
    public function setMatcheComment($matcheComment)
    {
        $this->matcheComment = $matcheComment;

        return $this;
    }

    /**
     * Get matcheComment
     *
     * @return boolean 
     */
    public function getMatcheComment()
    {
        return $this->matcheComment;
    }
}
