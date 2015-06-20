<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="sportPracticed", type="string", length=255)
     */
    private $sportPracticed;

    /**
     * @var string
     *
     * @ORM\Column(name="typeOfGame", type="string", length=255)
     */
    private $typeOfGame;

    /**
     * @var string
     *
     * @ORM\Column(name="habitsOfGame", type="text")
     */
    private $habitsOfGame;

    /**
     * @var string
     *
     * @ORM\Column(name="teamComment", type="text")
     */
    private $teamComment;


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
}
