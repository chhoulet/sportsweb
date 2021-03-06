<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="userSport")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id", nullable =true)
     */
    protected $favouriteSport;

     /**
     * @var string
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "50",
     *      minMessage = "Le nom de la ville doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de la ville ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="place", type="string", length=255))
     */
    protected $place;

    /**
     * @var string
     *    
     * @ORM\Column(name="postCode", type="string", length=255))
     */
    protected $postCode;

    /**
     * @var string
     *    
     * @ORM\Column(name="region", type="string", length=255))
     */
    protected $region;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Ground", inversedBy="userGround")
     * @ORM\JoinColumn(name="ground_id", referencedColumnName="id", nullable =true)
     */
    protected $ground;

    /**
     * @var string
     *
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="user")
     * @ORM\JoinTable(name="user_practiced")
     */
    protected $sportPracticed;

    /**
     * @var string
     *
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="user")
     * @ORM\JoinTable(name="user_viewed")
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
     * @ORM\Column(name="dateWarned", type="datetime", nullable=true)
     */
    private $dateWarned;

     /**
     * @var \DateTime
     *
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
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Ground", mappedBy="author")
     */
    protected $creatorGround;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="userTo")
     */
    protected $invitationsReceived;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="userAccepted")
     *
     */
    protected $invitationsAccepted;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="userDenied")
     *
     */
    protected $invitationDenied;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Article", mappedBy="author")
     */
    protected $article;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Invitation", mappedBy="userFrom")
     */
    protected $invitationsSent;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", inversedBy="friend")
     * @ORM\JoinColumn(name="friend_id", referencedColumnName="id")
     */
    protected $friend;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Sport", inversedBy="user")
     * @ORM\JoinTable(name="user_sport")
     */
    protected $sports;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Team", inversedBy="users")
     * @ORM\JoinTable(name="user_team")
     */
    protected $teams;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Team", inversedBy="askingUsers")
     * @ORM\JoinTable(name="askingUsers_teams")
     */
    protected $askedTeams;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Team", mappedBy="admin")
     */
    protected $teamsAdmin;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Comment", mappedBy="author")
     */
    protected $comment;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Message", mappedBy="reader")
     */
    protected $message;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Matche", mappedBy="players")
     * @ORM\JoinTable(name="players_matche")
     */
    private $matche;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Tournament", mappedBy="organizer")
     */
    private $tournament;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $image;

  /**
     * @Assert\File(maxSize="5000k",mimeTypes = {"image/jpeg","image/png"})
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        $this->image = $image;
    }


public function upload()
{
    // the file property can be empty if the field is not required
    if (null === $this->getFile()) {
        return;
    }

    // use the original file name here but you should
    // sanitize it at least to avoid any security issues

    // move takes the target directory and then the
    // target filename to move to
    $this->getFile()->move(
        __DIR__.'/../../../web/uploads/documents',
        $this->getFile()->getClientOriginalName()
    );

    // set the path property to the filename where you've saved the file
    $this->image =  "uploads/documents/" .$this->getFile()->getClientOriginalName();

    // clean up the file property as you won't need it anymore
    $this->file = null;
}


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

        $this->dateCreated = new \DateTime();
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

    /**
     * Add friend
     *
     * @param \UserBundle\Entity\UserBundle:User $friend
     * @return User
     */
    public function addFriend(\UserBundle\Entity\User $friend)
    {
        $this->friend[] = $friend;

        return $this;
    }

    /**
     * Remove friend
     *
     * @param \UserBundle\Entity\UserBundle:User $friend
     */
    public function removeFriend(\UserBundle\Entity\User $friend)
    {
        $this->friend->removeElement($friend);
    }

    /**
     * Get friend
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * Add sportPracticed
     *
     * @param \FrontOfficeBundle\Entity\Sport $sportPracticed
     * @return User
     */
    public function addSportPracticed(\FrontOfficeBundle\Entity\Sport $sportPracticed)
    {
        $this->sportPracticed[] = $sportPracticed;

        return $this;
    }

    /**
     * Remove sportPracticed
     *
     * @param \FrontOfficeBundle\Entity\Sport $sportPracticed
     */
    public function removeSportPracticed(\FrontOfficeBundle\Entity\Sport $sportPracticed)
    {
        $this->sportPracticed->removeElement($sportPracticed);
    }

    /**
     * Add sportViewed
     *
     * @param \FrontOfficeBundle\Entity\Sport $sportViewed
     * @return User
     */
    public function addSportViewed(\FrontOfficeBundle\Entity\Sport $sportViewed)
    {
        $this->sportViewed[] = $sportViewed;

        return $this;
    }

    /**
     * Remove sportViewed
     *
     * @param \FrontOfficeBundle\Entity\Sport $sportViewed
     */
    public function removeSportViewed(\FrontOfficeBundle\Entity\Sport $sportViewed)
    {
        $this->sportViewed->removeElement($sportViewed);
    }

    /**
     * Add sports
     *
     * @param \FrontOfficeBundle\Entity\Sport $sports
     * @return User
     */
    public function addSport(\FrontOfficeBundle\Entity\Sport $sports)
    {
        $this->sports[] = $sports;

        return $this;
    }

    /**
     * Remove sports
     *
     * @param \FrontOfficeBundle\Entity\Sport $sports
     */
    public function removeSport(\FrontOfficeBundle\Entity\Sport $sports)
    {
        $this->sports->removeElement($sports);
    }

    /**
     * Get sports
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSports()
    {
        return $this->sports;
    }

    /**
     * Add invitationsReceived
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsReceived
     * @return User
     */
    public function addInvitationsReceived(\FrontOfficeBundle\Entity\Invitation $invitationsReceived)
    {
        $this->invitationsReceived[] = $invitationsReceived;

        return $this;
    }

    /**
     * Remove invitationsReceived
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsReceived
     */
    public function removeInvitationsReceived(\FrontOfficeBundle\Entity\Invitation $invitationsReceived)
    {
        $this->invitationsReceived->removeElement($invitationsReceived);
    }

    /**
     * Get invitationsReceived
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitationsReceived()
    {
        return $this->invitationsReceived;
    }

    /**
     * Add invitationsSent
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsSent
     * @return User
     */
    public function addInvitationsSent(\FrontOfficeBundle\Entity\Invitation $invitationsSent)
    {
        $this->invitationsSent[] = $invitationsSent;

        return $this;
    }

    /**
     * Remove invitationsSent
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsSent
     */
    public function removeInvitationsSent(\FrontOfficeBundle\Entity\Invitation $invitationsSent)
    {
        $this->invitationsSent->removeElement($invitationsSent);
    }

    /**
     * Get invitationsSent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitationsSent()
    {
        return $this->invitationsSent;
    }

    /**
     * Add teams
     *
     * @param \FrontOfficeBundle\Entity\Team $teams
     * @return User
     */
    public function addTeam(\FrontOfficeBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;

        return $this;
    }

    /**
     * Remove teams
     *
     * @param \FrontOfficeBundle\Entity\Team $teams
     */
    public function removeTeam(\FrontOfficeBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Add teamsAdmin
     *
     * @param \FrontOfficeBundle\Entity\Team $teamsAdmin
     * @return User
     */
    public function addTeamsAdmin(\FrontOfficeBundle\Entity\Team $teamsAdmin)
    {
        $this->teamsAdmin[] = $teamsAdmin;

        return $this;
    }

    /**
     * Remove teamsAdmin
     *
     * @param \FrontOfficeBundle\Entity\Team $teamsAdmin
     */
    public function removeTeamsAdmin(\FrontOfficeBundle\Entity\Team $teamsAdmin)
    {
        $this->teamsAdmin->removeElement($teamsAdmin);
    }

    /**
     * Get teamsAdmin
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeamsAdmin()
    {
        return $this->teamsAdmin;
    }


    /**
     * Add article
     *
     * @param \FrontOfficeBundle\Entity\Article $article
     * @return User
     */
    public function addArticle(\FrontOfficeBundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \FrontOfficeBundle\Entity\Article $article
     */
    public function removeArticle(\FrontOfficeBundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set favouriteSport
     *
     * @param \FrontOfficeBundle\Entity\Sport $favouriteSport
     * @return User
     */
    public function setFavouriteSport(\FrontOfficeBundle\Entity\Sport $favouriteSport = null)
    {
        $this->favouriteSport = $favouriteSport;

        return $this;
    }

    /**
     * Get favouriteSport
     *
     * @return \FrontOfficeBundle\Entity\Sport 
     */
    public function getFavouriteSport()
    {
        return $this->favouriteSport;
    }

    /**
     * Set ground
     *
     * @param \FrontOfficeBundle\Entity\Ground $ground
     * @return User
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
     * Set place
     *
     * @param string $place
     * @return User
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
     * Add comment
     *
     * @param \FrontOfficeBundle\Entity\Comment $comment
     * @return User
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
     * Add message
     *
     * @param \FrontOfficeBundle\Entity\Message $message
     * @return User
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

    /**
     * Add invitation
     *
     * @param \UserBundle\Entity\User $invitation
     * @return User
     */
    public function addInvitation(\UserBundle\Entity\User $invitation)
    {
        $this->invitation[] = $invitation;

        return $this;
    }

    /**
     * Remove invitation
     *
     * @param \UserBundle\Entity\User $invitation
     */
    public function removeInvitation(\UserBundle\Entity\User $invitation)
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
     * Add askedTeams
     *
     * @param \FrontOfficeBundle\Entity\Team $askedTeams
     * @return User
     */
    public function addAskedTeam(\FrontOfficeBundle\Entity\Team $askedTeams)
    {
        $this->askedTeams[] = $askedTeams;

        return $this;
    }

    /**
     * Remove askedTeams
     *
     * @param \FrontOfficeBundle\Entity\Team $askedTeams
     */
    public function removeAskedTeam(\FrontOfficeBundle\Entity\Team $askedTeams)
    {
        $this->askedTeams->removeElement($askedTeams);
    }

    /**
     * Get askedTeams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAskedTeams()
    {
        return $this->askedTeams;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return User
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string 
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return User
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
     * Add tournament
     *
     * @param \FrontOfficeBundle\Entity\Tournament $tournament
     * @return User
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
     * Add invitationsAccepted
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsAccepted
     * @return User
     */
    public function addInvitationsAccepted(\FrontOfficeBundle\Entity\Invitation $invitationsAccepted)
    {
        $this->invitationsAccepted[] = $invitationsAccepted;

        return $this;
    }

    /**
     * Remove invitationsAccepted
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationsAccepted
     */
    public function removeInvitationsAccepted(\FrontOfficeBundle\Entity\Invitation $invitationsAccepted)
    {
        $this->invitationsAccepted->removeElement($invitationsAccepted);
    }

    /**
     * Get invitationsAccepted
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitationsAccepted()
    {
        return $this->invitationsAccepted;
    }

    /**
     * Add invitationDenied
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationDenied
     * @return User
     */
    public function addInvitationDenied(\FrontOfficeBundle\Entity\Invitation $invitationDenied)
    {
        $this->invitationDenied[] = $invitationDenied;

        return $this;
    }

    /**
     * Remove invitationDenied
     *
     * @param \FrontOfficeBundle\Entity\Invitation $invitationDenied
     */
    public function removeInvitationDenied(\FrontOfficeBundle\Entity\Invitation $invitationDenied)
    {
        $this->invitationDenied->removeElement($invitationDenied);
    }

    /**
     * Get invitationDenied
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitationDenied()
    {
        return $this->invitationDenied;
    }

    /**
     * Add matche
     *
     * @param \FrontOfficeBundle\Entity\Matche $matche
     * @return User
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
     * Add creatorGround
     *
     * @param \FrontOfficeBundle\Entity\Ground $creatorGround
     * @return User
     */
    public function addCreatorGround(\FrontOfficeBundle\Entity\Ground $creatorGround)
    {
        $this->creatorGround[] = $creatorGround;

        return $this;
    }

    /**
     * Remove creatorGround
     *
     * @param \FrontOfficeBundle\Entity\Ground $creatorGround
     */
    public function removeCreatorGround(\FrontOfficeBundle\Entity\Ground $creatorGround)
    {
        $this->creatorGround->removeElement($creatorGround);
    }

    /**
     * Get creatorGround
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreatorGround()
    {
        return $this->creatorGround;
    }
}
