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
     * @ORM\Column(name="address", type="string", length=150)
     */
    private $address;

    /**
     * @var integer
     *
     * @Assert\Range(
     *      min = 00000,
     *      max = 99999,
     *      minMessage = "Votre code postal doit comporter au moins 5 chiffres",
     *      maxMessage = "Votre code postal doit comporter au plus 5 chiffres"
     * )
     * @ORM\Column(name="postCode", type="integer")
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
     *      min = 00000000000,
     *      max = 99999999999,
     *      minMessage = "Votre N° de téléphone doit comporter au moins 11 chiffres",
     *      maxMessage = "Votre N° de téléphone doit comporter au plus 11 chiffres"
     * )
     * @ORM\Column(name="phoneNumber", type="integer")
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "150",
     *      minMessage = "Les heures d'ouverture doivent faire au moins {{ limit }} caractères",
     *      maxMessage = "Les heures d'ouverture  ne peuvent pas être plus longues que {{ limit }} caractères"
     * )
     * @ORM\Column(name="openingHours", type="string", length=255)
     */
    private $openingHours;

    /**
     * @var date
     *
     * @Assert\Date()
     * @ORM\Column(name="dateCreated", type="date")
     */
    private $dateCreated;

    /**
     * @var datetime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateUpdated", type="datetime", nullable=true)
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
}
