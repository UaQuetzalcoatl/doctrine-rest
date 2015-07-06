<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of UserGroup
 *
 * @ORM\Entity
 * @ORM\Table(name="user_groups")
 *
 * @author alex
 */
class UserGroup extends AbstractEntity
{
    const ADMIN_GROUP = 'admin';
    const EVERYONE_GROUP = 'everyone';
    const GUEST_GROUP = 'guest';
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     *
     * @var \App\Entity\Community
     * @ORM\ManyToOne(targetEntity="Community", inversedBy="userGroups")
     * @ORM\JoinColumn(name="community_id", referencedColumnName="id")
     */
    protected $community;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="User", mappedBy="userGroups", cascade={"persist"})
     **/
    protected $users;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="is_system")
     */
    protected $isSystem = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
    public function getUsers()
    {
        return $this->users;
    }

    /**
     *
     * @return boolean
     */
    public function getIsSystem()
    {
        return $this->isSystem;
    }

    /**
     *
     * @param string $name
     * @return \App\Entity\UserGroup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     *
     * @param \App\Entity\Community $community
     * @return \App\Entity\UserGroup
     */
    public function setCommunity(Community $community)
    {
        $this->community = $community;

        return $this;
    }

    /**
     * Add user to group
     *
     * @param \App\Entity\User $user
     * @return \App\Entity\UserGroup
     */
    public function addUser(User $user)
    {
        $this->users->add($user);
        $user->getUserGroups()->add($this);

        return $this;
    }

    /**
     * Remove user from group
     *
     * @param \App\Entity\User $user
     * @return \App\Entity\UserGroup
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
        $user->getUserGroups()->removeElement($this);

        return $this;
    }

    /**
     *
     * @param boolean $isSystem
     * @return \App\Entity\UserGroup
     */
    public function setIsSystem($isSystem)
    {
        $this->isSystem = (bool) $isSystem;

        return $this;
    }
}
