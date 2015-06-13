<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\PlayerRepository")
 */
class Player
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="sportPracticed", type="string", length=255)
     */
    private $sportPracticed;

    /**
     * @var string
     *
     * @ORM\Column(name="sportViewed", type="string", length=255)
     */
    private $sportViewed;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", length=255)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="player")
     */
    private $invitation;


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
     * Set username
     *
     * @param string $username
     * @return Player
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Player
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set sportPracticed
     *
     * @param string $sportPracticed
     * @return Player
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
     * Set sportViewed
     *
     * @param string $sportViewed
     * @return Player
     */
    public function setSportViewed($sportViewed)
    {
        $this->sportViewed = $sportViewed;

        return $this;
    }

    /**
     * Get sportViewed
     *
     * @return string 
     */
    public function getSportViewed()
    {
        return $this->sportViewed;
    }

    /**
     * Set age
     *
     * @param string $age
     * @return Player
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return string 
     */
    public function getAge()
    {
        return $this->age;
    }

    public function __toString()
    {
        return $this -> username;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invitation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add invitation
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitation
     * @return Player
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
}
