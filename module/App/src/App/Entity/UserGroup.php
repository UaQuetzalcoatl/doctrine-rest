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
     * @ORM\ManyToMany(targetEntity="User", mappedBy="userGroups")
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
}
