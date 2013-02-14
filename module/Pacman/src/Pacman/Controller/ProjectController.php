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
            'categories' => $this->getCategoryTable()->fetchByProject($project->id),
            'credentialTable' => $this->getCredentialTable(),
            'environmentTable' => $this->getEnvironmentTable(),
            'clusterTable' => $this->getClusterTable(),
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

    /**
     * get Category TableGateway
     *
     * @return Model\Category\Table
     */
    public function getCategoryTable()
    {
        return $this->getServiceLocator()->get('Model\Category\Table');
    }

    /**
     * get Credential TableGateway
     *
     * @return Model\Credential\Table
     */
    public function getCredentialTable()
    {
        return $this->getServiceLocator()->get('Model\Credential\Table');
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

    /**
     * get Cluster TableGateway
     *
     * @return Model\Cluster\Table
     */
    public function getClusterTable()
    {
        return $this->getServiceLocator()->get('Model\Cluster\Table');
    }
}
