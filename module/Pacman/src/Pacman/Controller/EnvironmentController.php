<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EnvironmentController extends AbstractActionController
{
    /**
     * list of environments
     */
    public function listAction()
    {
        return new ViewModel(array(
            'environments' => $this->getEnvironmentTable()->fetchAll(),
        ));
    }

    /**
     * Display environment info by id
     */
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        $environment = $this->getEnvironmentTable()->findEnvironment($id);
        if (!$environment) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel(array(
            'environment' => $environment,
        ));
    }

    /**
     * get Environment TableGateway
     *
     * @return Model\Environment\Table
     */
    public function getEnvironmentTable()
    {
        return $this->getServiceLocator()->get('Model\Environment\Table');
    }
}
