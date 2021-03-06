<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     *
     * @Assert\Length(
     *      min = "3",
     *      max = "80",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "4",
     *      max = "50",
     *      minMessage = "Le nom de votre sport pratiqué doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de votre sport pratiqué ne peut pas être plus long que {{ limit }} caractères"
     * )
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="team")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
     */
    private $sportPracticed;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "4",
     *      max = "255",
     *      minMessage = "Le lieu doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le lieu ne peut pas être plus long que {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "4",
     *      max = "50",
     *      minMessage = "Le type de jeu pratiqué doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le type de jeu pratiqué ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="typeOfGame", type="string", length=255)
     */
    private $typeOfGame;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "10",
     *      max = "250",
     *      minMessage = "Les habitudes de jeu doivent faire au moins {{ limit }} caractères",
     *      maxMessage = "Les habitudes de jeu ne peuvent pas être plus longues que {{ limit }} caractères"
     * )
     * @ORM\Column(name="habitsOfGame", type="text")
     */
    private $habitsOfGame;

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
     * @ORM\Column(name="dateUpdated", type="datetime", nullable=true)
     */
    private $dateUpdated;

     /**
     * @var boolean
     *
     * @ORM\Column(name="validationAdmin", type="boolean")
     */
    private $validationAdmin;

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
     * @Assert\Length(
     *      min = "10",
     *      max = "250",
     *      minMessage = "Votre commentaire doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre commentaire ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="teamComment", type="text", nullable=true)
     */
    private $teamComment;

     /**
     * @var boolean
     *     
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Ground", inversedBy="team")
     * @ORM\JoinColumn(name="ground_id", referencedColumnName="id")
     */
    private $ground;

     /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="teams")
     */
    private $users;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="askedTeams")
     */
    private $askingUsers;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="teamsAdmin")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id", nullable = true)
     */
    private $admin;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="teamFrom")
     */
    private $invitationsSentFromTeam;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="teamTo")
     */
    private $invitationsReceivedToTeam;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Comment", mappedBy="team")
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Message", mappedBy="team")
     */
    private $message;

     /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Matche", mappedBy="team")    
     */
    private $matche;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Tournament", mappedBy="teams")
     */
    private $tournament;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable = true)
     */
    private $image;

    /**
     * @Assert\File(
     *     maxSize = "5000k",
     *     mimeTypes = {"image/jpeg", "image/jpg", "image/gif", "image/png" },
     *     mimeTypesMessage = "Vous ne pouvez uploader que des ficihiers sous format gif,jpg, jpeg ou png!"
     * )
     */
    private $file;



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

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Team
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
     * @return Team
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
     * Set ground
     *
     * @param \FrontOfficeBundle\Entity\Ground $ground
     * @return Team
     */
    public function setGround(\FrontOfficeBundle\Entity\Ground $ground = null)
    {
        $this->ground = $ground;

        return $this;
    }

    /**
     * Get ground
     *
     * @return \FrontOfficeBundle\Entity\Ground 
     */
    public function getGround()
    {
        return $this->ground;
    }

    /**
     * Set validationAdmin
     *
     * @param boolean $validationAdmin
     * @return Team
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
     * @return Team
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
     * Set place
     *
     * @param string $place
     * @return Team
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
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \UserBundle\Entity\User $users
     * @return Team
     */
    public function addUser(\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \UserBundle\Entity\User $users
     */
    public function removeUser(\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set admin
     *
     * @param \UserBundle\Entity\User $admin
     * @return Team
     */
    public function setAdmin(\UserBundle\Entity\User $admin = null)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \UserBundle\Entity\User 
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Add invitationsSentFromTeam
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsSentFromTeam
     * @return Team
     */
    public function addInvitationsSentFromTeam(\FrontOfficeBundle\Entity\Invitation $invitationsSentFromTeam)
    {
        $this->invitationsSentFromTeam[] = $invitationsSentFromTeam;

        return $this;
    }

    /**
     * Remove invitationsSentFromTeam
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsSentFromTeam
     */
    public function removeInvitationsSentFromTeam(\FrontOfficeBundle\Entity\Invitation $invitationsSentFromTeam)
    {
        $this->invitationsSentFromTeam->removeElement($invitationsSentFromTeam);
    }

    /**
     * Get invitationsSentFromTeam
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitationsSentFromTeam()
    {
        return $this->invitationsSentFromTeam;
    }

    /**
     * Add invitationsReceivedToTeam
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsReceivedToTeam
     * @return Team
     */
    public function addInvitationsReceivedToTeam(\FrontOfficeBundle\Entity\Invitation $invitationsReceivedToTeam)
    {
        $this->invitationsReceivedToTeam[] = $invitationsReceivedToTeam;

        return $this;
    }

    /**
     * Remove invitationsReceivedToTeam
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsReceivedToTeam
     */
    public function removeInvitationsReceivedToTeam(\FrontOfficeBundle\Entity\Invitation $invitationsReceivedToTeam)
    {
        $this->invitationsReceivedToTeam->removeElement($invitationsReceivedToTeam);
    }

    /**
     * Get invitationsReceivedToTeam
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitationsReceivedToTeam()
    {
        return $this->invitationsReceivedToTeam;
    }

    /**
     * Add comment
     *
     * @param \FrontOfficeBundle\Entity\Comment $comment
     * @return Team
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
     * Add askingUsers
     *
     * @param \UserBundle\Entity\User $askingUsers
     * @return Team
     */
    public function addAskingUser(\UserBundle\Entity\User $askingUsers)
    {
        $this->askingUsers[] = $askingUsers;

        return $this;
    }

    /**
     * Remove askingUsers
     *
     * @param \UserBundle\Entity\User $askingUsers
     */
    public function removeAskingUser(\UserBundle\Entity\User $askingUsers)
    {
        $this->askingUsers->removeElement($askingUsers);
    }

    /**
     * Get askingUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAskingUsers()
    {
        return $this->askingUsers;
    }
    

    /**
     * Set active
     *
     * @param boolean $active
     * @return Team
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add tournament
     *
     * @param \FrontOfficeBundle\Entity\Tournament $tournament
     * @return Team
     */
    public function addTournament(\FrontOfficeBundle\Entity\Tournament $tournament)
    {
        $this->tournament[] = $tournament;

        return $this;
    }

    /**
     * Remove tournament
     *
     * @param \FrontOfficeBundle\Entity\Tournament $tournament
     */
    public function removeTournament(\FrontOfficeBundle\Entity\Tournament $tournament)
    {
        $this->tournament->removeElement($tournament);
    }

    /**
     * Get tournament
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Add matche
     *
     * @param \FrontOfficeBundle\Entity\Matche $matche
     * @return Team
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
     * Set image
     *
     * @param string $image
     * @return Team
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getFile()
    {
        return $this ->file;
    }

    public function setFile(UploadedFile $file = null)
    {
        return $this -> file = $file;
    }

    public function upload()
    {
        if ($this -> getFile() === null){
            return;
        }

        $this -> getFile()-> move(__DIR__ . "../../../web/uploads/documents", 
                                 $this -> getFile()->getClientOriginalName());

        $this -> image = "uploads/documents/".$this -> getFile() -> getClientOriginalName();

        $this -> file = null;
    }

    public function __toString() {
        return $this->name;
    }

    /**
     * Add message
     *
     * @param \FrontOfficeBundle\Entity\Message $message
     * @return Team
     */
    public function addMessage(\FrontOfficeBundle\Entity\Message $message)
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \FrontOfficeBundle\Entity\Message $message
     */
    public function removeMessage(\FrontOfficeBundle\Entity\Message $message)
    {
        $this->message->removeElement($message);
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessage()
    {
        return $this->message;
    }
}
