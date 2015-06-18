<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sportPracticed", type="string", length=255)
     */
    protected $sportPracticed;

    /**
     * @var string
     *
     * @ORM\Column(name="sportViewed", type="string", length=255)
     */
    protected $sportViewed;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", length=255)
     */
    protected $age;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="user")
     */
    protected $invitation;

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
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->invitation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set sportPracticed
     *
     * @param string $sportPracticed
     * @return User
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
     * @return User
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
     * @return User
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

    /**
     * Add invitation
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitation
     * @return User
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
