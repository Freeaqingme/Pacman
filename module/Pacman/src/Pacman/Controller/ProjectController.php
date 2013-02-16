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

class ProjectController extends AbstractActionController
{
    /**
     * list of projects
     */
    public function listAction()
    {
        return new ViewModel(array(
            'projects' => $this->getProjectTable()->fetchAll(),
        ));
    }

    /**
     * Display project info by id
     */
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        $project = $this->getProjectTable()->findProject($id);
        if (!$project) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel(array(
            'project' => $project,
        ));
    }

    /**
     * get Project TableGateway
     *
     * @return Model\Project\Table
     */
    public function getProjectTable()
    {
        return $this->getServiceLocator()->get('Model\Project\Table');
    }
}
