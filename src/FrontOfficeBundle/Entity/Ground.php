<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ground
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\GroundRepository")
 */
class Ground
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
     *      min = "2",
     *      max = "50",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="name", type="string", length=150)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "150",
     *      minMessage = "Votre addresse doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre addresse ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="address", type="string", length=150, nullable = true)
     */
    private $address;

    /**
     * @var integer
     *
     * @Assert\Range(
     *      min = 00,
     *      max = 99,
     *      minMessage = "Votre code postal doit comporter au moins 2 chiffres",
     *      maxMessage = "Votre code postal doit comporter au plus 2 chiffres"
     * )
     * @ORM\Column(name="postCode", type="integer", nullable = true)
     */
    private $postCode;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="ground")
     * @0RM\JoinTable(name="ground_sport", referencedColumnName="id")
     */
    private $sport;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "150",
     *      minMessage = "Le nom de la ville doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de la ville  ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="place", type="string", length=150)
     */
    private $place;

     /**
     * @var integer
     *
     * @Assert\Range(
     *      min = 0000000000,
     *      max = 9999999999,
     *      minMessage = "Votre N° de téléphone doit comporter au moins 10 chiffres",
     *      maxMessage = "Votre N° de téléphone doit comporter au plus 10 chiffres"
     * )
     * @ORM\Column(name="phoneNumber", type="integer", nullable = true)
     */
    private $phoneNumber;

    /**
     * @var string
     *     
     * @ORM\Column(name="openingHours", type="string", length=450, nullable = true)
     */
    private $openingHours;

    /**
     * @var string
     *     
     * @ORM\Column(name="mode", type="string")
     */
    private $mode;

    /**
     * @var string
     *     
     * @ORM\Column(name="region", type="string")
     */
    private $region;

    /**
     * @var string
     *     
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="creatorGround")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var boolean
     *     
     * @ORM\Column(name="fees", type="boolean")
     */
    private $fees;

    /**
     * @var string
     *   
     * @Assert\Length(
     *      max = "550",
     *      maxMessage = "Le commentaire ne peut pas être plus long que {{ limit }} caractères"
     * )  
     * @ORM\Column(name="comment", type="string", length=550, nullable = true)
     */
    private $comment;

    /**
     * @var date
     *
     * @Assert\Date()
     * @ORM\Column(name="dateCreated", type="date")
     */
    private $dateCreated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validAdmin", type="boolean")
     */
    private $validAdmin;

    /**
     * @var date
     *
     * @Assert\Date()
     * @ORM\Column(name="dateValidated", type="date", nullable = true)
     */
    private $dateValidated;


    /**
     * @var datetime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateUpdated", type="datetime", nullable = true)
     */
    private $dateUpdated;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="ground")
     */
    private $invitation;

     /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Team", mappedBy="ground")
     */
    private $team;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="ground")
     */
    private $userGround;


     /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Comment", mappedBy="ground")
     */
    private $com;

     /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Matche", mappedBy="ground")
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
     * Set name
     *
     * @param string $name
     * @return Ground
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
     * Set address
     *
     * @param string $address
     * @return Ground
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set sport
     *
     * @param string $sport
     * @return Ground
     */
    public function setSport($sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return string 
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Ground
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set openingHours
     *
     * @param string $openingHours
     * @return Ground
     */
    public function setOpeningHours($openingHours)
    {
        $this->openingHours = $openingHours;

        return $this;
    }

    /**
     * Get openingHours
     *
     * @return string 
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add invitation
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitation
     * @return Ground
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
     * Set place
     *
     * @param string $place
     * @return Ground
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Ground
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
     * @return Ground
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
     * Add team
     *
     * @param \FrontOfficeBundle\Entity\Team $team
     * @return Ground
     */
    public function addTeam(\FrontOfficeBundle\Entity\Team $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \FrontOfficeBundle\Entity\Team $team
     */
    public function removeTeam(\FrontOfficeBundle\Entity\Team $team)
    {
        $this->team->removeElement($team);
    }

    /**
     * Get team
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeam()
    {
        return $this->team;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sport = new \Doctrine\Common\Collections\ArrayCollection();
        $this->invitation = new \Doctrine\Common\Collections\ArrayCollection();
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set postCode
     *
     * @param integer $postCode
     * @return Ground
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return integer 
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Add sport
     *
     * @param \FrontOfficeBundle\Entity\Sport $sport
     * @return Ground
     */
    public function addSport(\FrontOfficeBundle\Entity\Sport $sport)
    {
        $this->sport[] = $sport;

        return $this;
    }

    /**
     * Remove sport
     *
     * @param \FrontOfficeBundle\Entity\Sport $sport
     */
    public function removeSport(\FrontOfficeBundle\Entity\Sport $sport)
    {
        $this->sport->removeElement($sport);
    }

    /**
     * Set mode
     *
     * @param string $mode
     * @return Ground
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
     * Set comment
     *
     * @param string $comment
     * @return Ground
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set validAdmin
     *
     * @param boolean $validAdmin
     * @return Ground
     */
    public function setValidAdmin($validAdmin)
    {
        $this->validAdmin = $validAdmin;

        return $this;
    }

    /**
     * Get validAdmin
     *
     * @return boolean 
     */
    public function getValidAdmin()
    {
        return $this->validAdmin;
    }

    /**
     * Set fees
     *
     * @param boolean $fees
     * @return Ground
     */
    public function setFees($fees)
    {
        $this->fees = $fees;

        return $this;
    }

    /**
     * Get fees
     *
     * @return boolean 
     */
    public function getFees()
    {
        return $this->fees;
    }

    /**
     * Set dateValidated
     *
     * @param \DateTime $dateValidated
     * @return Ground
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
     * Add com
     *
     * @param \FrontOfficeBundle\Entity\Comment $com
     * @return Ground
     */
    public function addCom(\FrontOfficeBundle\Entity\Comment $com)
    {
        $this->com[] = $com;

        return $this;
    }

    /**
     * Remove com
     *
     * @param \FrontOfficeBundle\Entity\Comment $com
     */
    public function removeCom(\FrontOfficeBundle\Entity\Comment $com)
    {
        $this->com->removeElement($com);
    }

    /**
     * Get com
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCom()
    {
        return $this->com;
    }

    /**
     * Add userGround
     *
     * @param \UserBundle\Entity\User $userGround
     * @return Ground
     */
    public function addUserGround(\UserBundle\Entity\User $userGround)
    {
        $this->userGround[] = $userGround;

        return $this;
    }

    /**
     * Remove userGround
     *
     * @param \UserBundle\Entity\User $userGround
     */
    public function removeUserGround(\UserBundle\Entity\User $userGround)
    {
        $this->userGround->removeElement($userGround);
    }

    /**
     * Get userGround
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserGround()
    {
        return $this->userGround;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Ground
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Add matche
     *
     * @param \FrontOfficeBundle\Entity\Matche $matche
     * @return Ground
     */
    public function addMatche(\FrontOfficeBundle\Entity\Matche $matche)
    {
        $this->matche[] = $matche;

        return $this;
    }

    /**
     * Remove matche
     *
     * @param \FrontOfficeBundle\Entity\Matche $matche
     */
    public function removeMatche(\FrontOfficeBundle\Entity\Matche $matche)
    {
        $this->matche->removeElement($matche);
    }

    /**
     * Get matche
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatche()
    {
        return $this->matche;
    }

    /**
     * Set author
     *
     * @param \UserBundle\Entity\User $author
     * @return Ground
     */
    public function setAuthor(\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
