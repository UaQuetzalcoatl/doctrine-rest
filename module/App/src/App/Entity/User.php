<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ZfrOAuth2\Server\Entity\TokenOwnerInterface;

/**
 * User Entity
 * 
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 * @author alex
 */
class User extends AbstractEntity implements TokenOwnerInterface
{
    /**
     * @var string
     * @ORM\Column(type="string", unique=true,  length=255)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=128)
     */
    protected $password;
    
    /**
     * @var string
     * @ORM\Column(type="string", name="first_name",  length=255)
     */
    protected $firstName;
    
    /**
     * @var string
     * @ORM\Column(type="string", name="last_name",  length=255)
     */
    protected $lastName;
    
    /**
     *
     * @var \App\Entity\Community
     * @ORM\ManyToOne(targetEntity="Community", inversedBy="users")
     * @ORM\JoinColumn(name="community_id", referencedColumnName="id") 
     */
    protected $community;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="UserGroup", inversedBy="users")
     * @ORM\JoinTable(name="users_groups")
     **/
    protected $userGroups;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userGroups = new ArrayCollection;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     * 
     * @param string $email
     * @return \App\Entity\User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * 
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * 
     * @return \App\Entity\Community
     */
    public function getCommunity()
    {
        return $this->community;
    }

    /**
     * 
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getUserGroups()
    {
        return $this->userGroups;
    }

    /**
     * 
     * @param string $firstName
     * @return \App\Entity\User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        
        return $this;
    }

    /**
     * 
     * @param string $firstName
     * @return \App\Entity\User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        
        return $this;
    }

    /**
     * 
     * @param \App\Entity\Community $community
     * @return \App\Entity\User
     */
    public function setCommunity(Community $community)
    {
        $this->community = $community;
        
        return $this;
    }

    /**
     * Returns user id. 
     * ZfrOAuth2\Server\Entity\TokenOwnerInterface implementation
     * 
     * @return int
     */
    public function getTokenOwnerId()
    {
        return $this->id;
    }
}
