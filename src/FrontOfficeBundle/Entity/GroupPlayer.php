<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="practicedSport", type="string", length=255)
     */
    private $practicedSport;

    /**
     * @var string
     *
     * @ORM\Column(name="typeOfGame", type="string", length=255)
     */
    private $typeOfGame;

    /**
     * @var string
     *
     * @ORM\Column(name="club", type="string", length=255)
     */
    private $club;

    /**
     * @var string
     *
     * @ORM\Column(name="habitsOfGame", type="text")
     */
    private $habitsOfGame;

    /**
     * @var string
     *
     * @ORM\Column(name="groupComment", type="text")
     */
    private $groupComment;


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
}
