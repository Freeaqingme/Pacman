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

class IndexController extends AbstractActionController
{
    /**
     * Default action / Homepage
     * @return ViewModel
     */
    public function indexAction()
    {
        $sm = $this->getServiceLocator();
        $projectTable = $sm->get('Pacman\Model\Project\ProjectTable');

        return new ViewModel(array(
            'projects' => $projectTable->fetchLatest(),
        ));
    }
}
