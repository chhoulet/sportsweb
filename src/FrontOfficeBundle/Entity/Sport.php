<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\SportRepository")
 */
class Sport
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
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="sportPracticed")
     */
    private $practicedUsers;
   
    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="sportViewed")
     */
    private $viewedUsers;
   


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
     * @return Sport
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
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Add practicedUsers
     *
     * @param \UserBundle\Entity\User $practicedUsers
     * @return Sport
     */
    public function addPracticedUser(\UserBundle\Entity\User $practicedUsers)
    {
        $this->practicedUsers[] = $practicedUsers;

        return $this;
    }

    /**
     * Remove practicedUsers
     *
     * @param \UserBundle\Entity\User $practicedUsers
     */
    public function removePracticedUser(\UserBundle\Entity\User $practicedUsers)
    {
        $this->practicedUsers->removeElement($practicedUsers);
    }

    /**
     * Get practicedUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPracticedUsers()
    {
        return $this->practicedUsers;
    }

    /**
     * Add viewedUsers
     *
     * @param \UserBundle\Entity\User $viewedUsers
     * @return Sport
     */
    public function addViewedUser(\UserBundle\Entity\User $viewedUsers)
    {
        $this->viewedUsers[] = $viewedUsers;

        return $this;
    }

    /**
     * Remove viewedUsers
     *
     * @param \UserBundle\Entity\User $viewedUsers
     */
    public function removeViewedUser(\UserBundle\Entity\User $viewedUsers)
    {
        $this->viewedUsers->removeElement($viewedUsers);
    }

    /**
     * Get viewedUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getViewedUsers()
    {
        return $this->viewedUsers;
    }

    public function __toString()
    {
        return $this -> name;
    }
}
