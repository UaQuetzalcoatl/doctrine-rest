<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Community
 * 
 * @ORM\Entity
 * @ORM\Table(name="communities")
 *
 * @author alex
 */
class Community extends AbstractEntity
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $name;
    
    /**
     * @var integer
     * @ORM\Column(type="integer", name="max_users", nullable = true)
     */
    protected $maxUsers;
    
    /**
     * @var integer
     * @ORM\Column(type="integer", name="max_user_groups", nullable = true)
     */
    protected $maxUsersGroups;
    
    /**
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="User", mappedBy="community")
     */
    protected $users;
    
    /**
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="UserGroup", mappedBy="community")
     */
    protected $userGroups;
    
    /**
     * @var bool
     * @ORM\Column(type="boolean", name="is_blocked")
     */
    protected $isBlocked = false;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection;
        $this->userGroups = new ArrayCollection;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getMaxUsers()
    {
        return $this->maxUsers;
    }

    public function getMaxUsersGroups()
    {
        return $this->maxUsersGroups;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function getUserGroups()
    {
        return $this->userGroups;
    }

    public function getIsBlocked()
    {
        return $this->isBlocked;
    }

    /**
     * Set communtiy name
     * 
     * @param string $name
     * @return \App\Entity\Community
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * Set max number of users. Null = unlimited.
     * 
     * @param int|null $maxUsers
     * @return \App\Entity\Community
     */
    public function setMaxUsers($maxUsers)
    {
        $this->maxUsers = $maxUsers;
        
        return $this;
    }

    /**
     * Set max number of user groups. Null = unlimited.
     * 
     * @param int|null $maxUsersGroups
     * @return \App\Entity\Community
     */
    public function setMaxUsersGroups($maxUsersGroups)
    {
        $this->maxUsersGroups = $maxUsersGroups;
        
        return $this;
    }

    /**
     * Add user to community
     * 
     * @param \App\Entity\User $user
     * @return \App\Entity\Community
     * @throws \RuntimeException
     */
    public function addUser(User $user)
    {
        if (null !== $this->maxUsers && $this->maxUsers <= $this->users->count()) {
            throw new \RuntimeException('Max number of community users reached');
        }
        
        $this->users->add($user);
        $user->setCommunity($this);
        
        return $this;
    }
    
    /**
     * Remove user from community
     * 
     * @param \App\Entity\User $user
     * @return \App\Entity\Community
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
        
        return $this;
    }
    
    /**
     * Add user group to community
     * 
     * @param \App\Entity\UserGroup $userGroup
     * @return \App\Entity\Community
     * @throws \RuntimeException
     */
    public function addUserGroup(UserGroup $userGroup)
    {
        if (null !== $this->maxUsersGroups && $this->maxUsersGroups <= $this->userGroups->count()) {
            throw new \RuntimeException('Max number of user groups reached');
        }
        
        $this->userGroups->add($userGroup);
        $userGroup->setCommunity($this);
        
        return $this;
    }
    
    /**
     * Remove user group from community
     * 
     * @param \App\Entity\UserGroup $userGroup
     * @return \App\Entity\Community
     * @throws \InvalidArgumentException
     */
    public function removeUserGroup(UserGroup $userGroup)
    {
        if ($userGroup->getIsSystem()) {
            throw new \InvalidArgumentException('User group is system and can\'t be deleted');
        }
        
        $this->userGroups->removeElement($userGroup);
        
        return $this;
    }

    /**
     * Block/Unblock community
     * 
     * @param bool $isBlocked
     * @return \App\Entity\Community
     */
    public function setIsBlocked($isBlocked)
    {
        $this->isBlocked = (bool) $isBlocked;
        
        return $this;
    }
}
