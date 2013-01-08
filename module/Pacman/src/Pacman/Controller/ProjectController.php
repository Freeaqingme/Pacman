<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @author Rob Quist ()
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Controller;

use Pacman\Model\Project\ProjectTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProjectController extends AbstractActionController
{
    protected $projectTable;

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
        $id = $this->params()->fromRoute('id', 0);
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
     * @return ProjectTable
     */
    public function getProjectTable()
    {
        if (!$this->projectTable) {
            $sm = $this->getServiceLocator();
            $this->projectTable = $sm->get('Pacman\Model\Project\ProjectTable');
        }
        return $this->projectTable;
    }
}
