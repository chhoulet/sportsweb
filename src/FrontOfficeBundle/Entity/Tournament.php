<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\TournamentRepository")
 */
class Tournament
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
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     * @var integer
     *
     * @ORM\Column(name="department", type="integer")
     */
    private $department;

    /**
     * @var integer
     *
     * @ORM\Column(name="region", type="integer")
     */
    private $region;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBegining", type="datetime")
     */
    private $dateBegining;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnding", type="datetime")
     */
    private $dateEnding;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Matche", mappedBy="tournament")
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
     * @return Tournament
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
     * Set place
     *
     * @param string $place
     * @return Tournament
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
     * Set department
     *
     * @param integer $department
     * @return Tournament
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return integer 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set region
     *
     * @param integer $region
     * @return Tournament
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return integer 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set dateBegining
     *
     * @param \DateTime $dateBegining
     * @return Tournament
     */
    public function setDateBegining($dateBegining)
    {
        $this->dateBegining = $dateBegining;

        return $this;
    }

    /**
     * Get dateBegining
     *
     * @return \DateTime 
     */
    public function getDateBegining()
    {
        return $this->dateBegining;
    }

    /**
     * Set dateEnding
     *
     * @param \DateTime $dateEnding
     * @return Tournament
     */
    public function setDateEnding($dateEnding)
    {
        $this->dateEnding = $dateEnding;

        return $this;
    }

    /**
     * Get dateEnding
     *
     * @return \DateTime 
     */
    public function getDateEnding()
    {
        return $this->dateEnding;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Tournament
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
     * Set description
     *
     * @param string $description
     * @return Tournament
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->matche = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add matche
     *
     * @param \FrontOfficeBundle\Entity\Matche $matche
     * @return Tournament
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
}
