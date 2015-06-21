<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * GroupPlayer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\GroupPlayerRepository")
 */
class GroupPlayer
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
     *      max = "80",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "4",
     *      max = "50",
     *      minMessage = "Le nom de votre sport pratiqué doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de votre sport pratiqué ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="practicedSport", type="string", length=255)
     */
    private $practicedSport;

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
     *      min = "4",
     *      max = "50",
     *      minMessage = "Le nom du club doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom du club ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="club", type="string", length=255)
     */
    private $club;

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
     * @var string
     *
     * @Assert\Length(
     *      min = "10",
     *      max = "250",
     *      minMessage = "Votre commentaire doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre commentaire ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="groupComment", type="text",nullable=true)
     */
    private $groupComment;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Ground", inversedBy="groupPlayer")
     * @ORM\JoinColumn(name="ground_id", referencedColumnName="id")
     */
    private $ground;


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
     * @return GroupPlayer
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
     * Set practicedSport
     *
     * @param string $practicedSport
     * @return GroupPlayer
     */
    public function setPracticedSport($practicedSport)
    {
        $this->practicedSport = $practicedSport;

        return $this;
    }

    /**
     * Get practicedSport
     *
     * @return string 
     */
    public function getPracticedSport()
    {
        return $this->practicedSport;
    }

    /**
     * Set typeOfGame
     *
     * @param string $typeOfGame
     * @return GroupPlayer
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
     * Set club
     *
     * @param string $club
     * @return GroupPlayer
     */
    public function setClub($club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return string 
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set habitsOfGame
     *
     * @param string $habitsOfGame
     * @return GroupPlayer
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
     * Set groupComment
     *
     * @param string $groupComment
     * @return GroupPlayer
     */
    public function setGroupComment($groupComment)
    {
        $this->groupComment = $groupComment;

        return $this;
    }

    /**
     * Get groupComment
     *
     * @return string 
     */
    public function getGroupComment()
    {
        return $this->groupComment;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return GroupPlayer
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
     * @return GroupPlayer
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
     * @return GroupPlayer
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
}
