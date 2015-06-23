<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @ORM\Column(name="sportPracticed", type="string", length=255)
     */
    protected $sportPracticed;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="sportViewed", type="string", length=255)
     */
    protected $sportViewed;

    /**
     * @var integer
     *
     * @Assert\Type(type="integer", message="La valeur {{ value }} n'est pas un type {{ type }} valide.Vous devez rentrer deux chiffres seulement.")
     * @ORM\Column(name="age", type="integer")
     */
    protected $age;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validationAdmin", type="boolean", nullable=true)
     */
    protected $validationAdmin;

     /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateValidated", type="datetime", nullable=true)
     */
    private $dateValidated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="userWarned", type="boolean", nullable=true)
     */
    protected $userWarned;

     /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateWarned", type="datetime", nullable=true)
     */
    private $dateWarned;

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

    /**
     * Set validationAdmin
     *
     * @param boolean $validationAdmin
     * @return User
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
     * Set userWarned
     *
     * @param boolean $userWarned
     * @return User
     */
    public function setUserWarned($userWarned)
    {
        $this->userWarned = $userWarned;

        return $this;
    }

    /**
     * Get userWarned
     *
     * @return boolean 
     */
    public function getUserWarned()
    {
        return $this->userWarned;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return User
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
     * Set dateValidated
     *
     * @param \DateTime $dateValidated
     * @return User
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
     * Set dateWarned
     *
     * @param \DateTime $dateWarned
     * @return User
     */
    public function setDateWarned($dateWarned)
    {
        $this->dateWarned = $dateWarned;

        return $this;
    }

    /**
     * Get dateWarned
     *
     * @return \DateTime 
     */
    public function getDateWarned()
    {
        return $this->dateWarned;
    }
}
