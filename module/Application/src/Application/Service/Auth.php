<?php

namespace Application\Service;

namespace ZfcUser\Service;

use Zend\Authentication\AuthenticationService;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Crypt\Password\Bcrypt;
use ZfcBase\EventManager\EventProvider;
use ZfcUser\Mapper\UserInterface as UserMapperInterface;
use ZfcUser\Options\UserServiceOptionsInterface;

class Auth extends EventProvider implements ServiceManagerAwareInterface
{
    public function redirectUnauthedUser(MvcEvent $e)
    {
        var_dump($e); exit;

    }
}
