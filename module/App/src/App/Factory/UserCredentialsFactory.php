<?php

namespace App\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use App\Auth\UserCredentialsCallable;

/**
 * Description of UserCredentialsFactory
 *
 * @author alex
 */
class UserCredentialsFactory implements FactoryInterface
{
    /**
     * Creates service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return App\Auth\UserCredentialsCallable
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new UserCredentialsCallable($serviceLocator->get('doctrine.entitymanager.orm_default'));
    }
}
