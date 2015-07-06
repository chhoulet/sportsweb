<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Team
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\TeamRepository")
 */
class Team
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
     *
     * @Assert\Length(
     *      min = "3",
     *      max = "80",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "4",
     *      max = "50",
     *      minMessage = "Le nom de votre sport pratiqué doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de votre sport pratiqué ne peut pas être plus long que {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="sportPracticed", type="string", length=255)
     */
    private $sportPracticed;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "4",
     *      max = "255",
     *      minMessage = "Le lieu doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le lieu ne peut pas être plus long que {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "4",
     *      max = "50",
     *      minMessage = "Le type de jeu pratiqué doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le type de jeu pratiqué ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="typeOfGame", type="string", length=255)
     */
    private $typeOfGame;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "10",
     *      max = "250",
     *      minMessage = "Les habitudes de jeu doivent faire au moins {{ limit }} caractères",
     *      maxMessage = "Les habitudes de jeu ne peuvent pas être plus longues que {{ limit }} caractères"
     * )
     * @ORM\Column(name="habitsOfGame", type="text")
     */
    private $habitsOfGame;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateUpdated", type="datetime", nullable=true)
     */
    private $dateUpdated;

     /**
     * @var boolean
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
     * @var string
     *
     * @Assert\Length(
     *      min = "10",
     *      max = "250",
     *      minMessage = "Votre commentaire doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre commentaire ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="teamComment", type="text", nullable=true)
     */
    private $teamComment;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Ground", inversedBy="team")
     * @ORM\JoinColumn(name="ground_id", referencedColumnName="id")
     */
    private $ground;

     /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="teams")
     */
    private $users;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="teamsAdmin")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id")
     */
    private $admin;

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
     * @return Team
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
     * Set sportPracticed
     *
     * @param string $sportPracticed
     * @return Team
     */
    public function setSportPracticed($sportPracticed)
    {
        $this->sportPracticed = $sportPracticed;

        return $this;
    }

    /**
     * Get sportPracticed
     *
     * @return string 
     */
    public function getSportPracticed()
    {
        return $this->sportPracticed;
    }

    /**
     * Set typeOfGame
     *
     * @param string $typeOfGame
     * @return Team
     */
    public function setTypeOfGame($typeOfGame)
    {
        $this->typeOfGame = $typeOfGame;

        return $this;
    }

    /**
     * Get typeOfGame
     *
     * @return string 
     */
    public function getTypeOfGame()
    {
        return $this->typeOfGame;
    }

    /**
     * Set habitsOfGame
     *
     * @param string $habitsOfGame
     * @return Team
     */
    public function setHabitsOfGame($habitsOfGame)
    {
        $this->habitsOfGame = $habitsOfGame;

        return $this;
    }

    /**
     * Get habitsOfGame
     *
     * @return string 
     */
    public function getHabitsOfGame()
    {
        return $this->habitsOfGame;
    }

    /**
     * Set teamComment
     *
     * @param string $teamComment
     * @return Team
     */
    public function setTeamComment($teamComment)
    {
        $this->teamComment = $teamComment;

        return $this;
    }

    /**
     * Get teamComment
     *
     * @return string 
     */
    public function getTeamComment()
    {
        return $this->teamComment;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Team
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
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Team
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime 
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set ground
     *
     * @param \FrontOfficeBundle\Entity\Ground $ground
     * @return Team
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
     * Set validationAdmin
     *
     * @param boolean $validationAdmin
     * @return Team
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
     * @return Team
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
     * Set place
     *
     * @param string $place
     * @return Team
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
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \UserBundle\Entity\User $users
     * @return Team
     */
    public function addUser(\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \UserBundle\Entity\User $users
     */
    public function removeUser(\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set admin
     *
     * @param \UserBundle\Entity\User $admin
     * @return Team
     */
    public function setAdmin(\UserBundle\Entity\User $admin = null)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \UserBundle\Entity\User 
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}
