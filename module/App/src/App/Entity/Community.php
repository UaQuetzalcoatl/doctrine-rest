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
}
