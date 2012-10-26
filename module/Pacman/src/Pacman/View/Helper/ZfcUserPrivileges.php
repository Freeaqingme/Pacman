<?php

namespace ZfcUser\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService;
use ZfcUser\Entity\UserInterface as User;

class ZfcUserPrivileges extends AbstractHelper
{
    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * __invoke
     *
     * @access public
     * @return String
     */
    public function __invoke(User $user = null)
    {
        if (null === $user) {
            if ($this->getAuthService()->hasIdentity()) {
                $user = $this->getAuthService()->getIdentity();
            } else {
                return false;
            }
        }
        $returnValue = '';
        foreach ($user->getGlobalPrivileges() as $key => $value) {
            $returnValue .= '<br/>Key: ' . $key . ' -- Value: ' . $value;
        }
        
        return $returnValue;
    }

    /**
     * Get authService.
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * Set authService.
     *
     * @param AuthenticationService $authService
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
        return $this;
    }
}
