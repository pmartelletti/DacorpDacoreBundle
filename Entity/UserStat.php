<?php


namespace Dacorp\CoreBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Dacorp\CoreBundle\Entity\DacorpMedia;

/**
 * @ORM\Entity
 * @ORM\Table(name="dacore_user_stat")
 * @ORM\Entity(repositoryClass="Dacorp\CoreBundle\Repository\UserStatRepository")
 * @ORM\HasLifecycleCallbacks
 *
 *  */
class UserStat
{

    /**
     * @ORM\Id
     * @ORM\Column(name="user_stat_id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Number of vote Up
     * @var integer $nbVoteUp
     *
     * @ORM\Column(name="user_nb_vote_up", type="smallint", nullable=true)
     */
    private $nbVoteUp=0;

    /**
     * Number of vote Down
     * @var integer $nbVoteDown
     *
     * @ORM\Column(name="user_nb_vote_down", type="smallint", nullable=true)
     */
    private $nbVoteDown=0;

    /**
     * Number of Rating
     * @var integer $nbRating
     *
     * @ORM\Column(name="user_nb_rating", type="smallint", nullable=true)
     */
    private $nbRating=1;


    /**
     * Number of comments
     * @var float $nbComments
     *
     * @ORM\Column(name="user_nb_comments", type="smallint", nullable=true)
     */
    private $nbComments=0;


    /**
     * Number of Pictures uploaded
     * @var float $nbPictures
     *
     * @ORM\Column(name="user_nb_pictures", type="smallint", nullable=true)
     */
    private $nbPictures=0;

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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    
        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set nbVoteUp
     *
     * @param integer $nbVoteUp
     * @return User
     */
    public function setNbVoteUp($nbVoteUp)
    {
        $this->nbVoteUp = $nbVoteUp;
    
        return $this;
    }

    /**
     * Get nbVoteUp
     *
     * @return integer 
     */
    public function getNbVoteUp()
    {
        return $this->nbVoteUp;
    }

    /**
     * Set nbVoteDown
     *
     * @param integer $nbVoteDown
     * @return User
     */
    public function setNbVoteDown($nbVoteDown)
    {
        $this->nbVoteDown = $nbVoteDown;
    
        return $this;
    }

    /**
     * Get nbVoteDown
     *
     * @return integer 
     */
    public function getNbVoteDown()
    {
        return $this->nbVoteDown;
    }

    /**
     * Set nbRating
     *
     * @param integer $nbRating
     * @return User
     */
    public function setNbRating($nbRating)
    {
        $this->nbRating = $nbRating;
    
        return $this;
    }

    /**
     * Get nbRating
     *
     * @return integer 
     */
    public function getNbRating()
    {
        return $this->nbRating;
    }

    /**
     * Set nbComment
     *
     * @param integer $nbComment
     * @return User
     */
    public function setNbComment($nbComment)
    {
        $this->nbComment = $nbComment;
    
        return $this;
    }

    /**
     * Get nbComment
     *
     * @return integer 
     */
    public function getNbComment()
    {
        return $this->nbComment;
    }

    /**
     * Set nbPictures
     *
     * @param integer $nbPictures
     * @return User
     */
    public function setNbPictures($nbPictures)
    {
        $this->nbPictures = $nbPictures;
    
        return $this;
    }

    /**
     * Get nbPictures
     *
     * @return integer 
     */
    public function getNbPictures()
    {
        return $this->nbPictures;
    }

    /**
     * Set address
     *
     * @param \Dacorp\CoreBundle\Entity\Address $address
     * @return User
     */
    public function setAddress(\Dacorp\CoreBundle\Entity\Address $address = null)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return \Dacorp\CoreBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set userRole
     *
     * @param \Dacorp\CoreBundle\Entity\UserRole $userRole
     * @return User
     */
    public function setUserRole(\Dacorp\CoreBundle\Entity\UserRole $userRole = null)
    {
        $this->userRole = $userRole;
    
        return $this;
    }

    /**
     * Get userRole
     *
     * @return \Dacorp\CoreBundle\Entity\UserRole 
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * Set currentAvatar
     *
     * @param \Dacorp\CoreBundle\Entity\DacorpMedia $currentAvatar
     * @return User
     */
    public function setCurrentAvatar(\Dacorp\CoreBundle\Entity\DacorpMedia $currentAvatar = null)
    {
        $this->currentAvatar = $currentAvatar;
    
        return $this;
    }

    /**
     * Get currentAvatar
     *
     * @return \Dacorp\CoreBundle\Entity\DacorpMedia 
     */
    public function getCurrentAvatar()
    {
        return $this->currentAvatar;
    }

    /**
     * Set nbComments
     *
     * @param integer $nbComments
     * @return UserStat
     */
    public function setNbComments($nbComments)
    {
        $this->nbComments = $nbComments;
    
        return $this;
    }

    /**
     * Get nbComments
     *
     * @return integer 
     */
    public function getNbComments()
    {
        return $this->nbComments;
    }
}