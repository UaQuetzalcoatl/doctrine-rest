<?php

namespace App\Auth;

use Doctrine\ORM\EntityManager;
use App\Security\Password;

/**
 * Description of UserCredentialsCallable.
 *
 * @author alex
 */
class UserCredentialsCallable
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * Constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * magic method implementation.
     *
     * @param string $email
     * @param string $password
     *
     * @return null|\App\Entity\User
     */
    public function __invoke($email, $password)
    {
        $user = $this->entityManager->getRepository('App\Entity\User')
            ->findOneBy(['email' => $email]);

        if (!$user) {
            return null;
        }

        if (Password::validate($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }
}
