<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Entity\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Length(
     *      min = "10",
     *      max = "255",
     *      minMessage = "Votre titre doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre titre ne peut pas être plus long que {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\Length(
     *      min = "10",
     *      max = "2500",
     *      minMessage = "Votre article doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre article ne peut pas être plus long que {{ limit }} caractères"
     * )
     */
    private $content;

     /**
     * @var boolean
     *
     *
     * @ORM\Column(name="validationAdmin", type="boolean")
     */
    private $validationAdmin;

    /**
     * @var boolean
     *
     *
     * @ORM\Column(name="warned", type="boolean")
     */
    private $warned;

    /**
     * @var string
     *
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="articles")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
     */
    private $sport;

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
     * @ORM\Column(name="dateUpdated", type="date", nullable = true)
     */
    private $dateUpdated;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="dateValidated", type="date", nullable = true)
     */
    private $dateValidated;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Comment", mappedBy="article")
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", inversedBy="article")
     * @ORM\JoinTable(name="articles_user")
     */
    private $author;

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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Article
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
     * @return Article
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
     * Constructor
     */
    public function __construct()
    {
        $this->comment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comment
     *
     * @param \FrontOfficeBundle\Entity\Comment $comment
     * @return Article
     */
    public function addComment(\FrontOfficeBundle\Entity\Comment $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \FrontOfficeBundle\Entity\Comment $comment
     */
    public function removeComment(\FrontOfficeBundle\Entity\Comment $comment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set validationAdmin
     *
     * @param boolean $validationAdmin
     * @return Article
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
     * Set dateValidated
     *
     * @param \DateTime $dateValidated
     * @return Article
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
     * Set warned
     *
     * @param boolean $warned
     * @return Article
     */
    public function setWarned($warned)
    {
        $this->warned = $warned;

        return $this;
    }

    /**
     * Get warned
     *
     * @return boolean 
     */
    public function getWarned()
    {
        return $this->warned;
    }

    /**
     * Add author
     *
     * @param \UserBundle\Entity\User $author
     * @return Article
     */
    public function addAuthor(\UserBundle\Entity\User $author)
    {
        $this->author[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \UserBundle\Entity\User $author
     */
    public function removeAuthor(\UserBundle\Entity\User $author)
    {
        $this->author->removeElement($author);
    }

    /**
     * Get author
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Article
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
