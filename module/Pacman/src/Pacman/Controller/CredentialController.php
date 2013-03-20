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

use Pacman\Model\Credential;
use Pacman\Form\CredentialForm;

class CredentialController extends AbstractActionController
{
    /**
     * list all credentials
     * @todo Delete this since we don't want this
     */
    public function listAction()
    {
        return new ViewModel(array(
            'credentials' => $this->getCredentialTable()->fetchAll(),
        ));
    }

    /**
     * Display credential info by id
     */
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        $credential = $this->getCredentialTable()->findCredential($id);
        if (!credential) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel(array(
            'credential' => $credential,
            'project' => $this->getProjectTable()->fetchByCredential($credential->id),
            'categories' => $this->getCategoryTable()->fetchByCredential($credential->id),
            'credentialTable' => $this->getCredentialTable(),
            'environmentTable' => $this->getEnvironmentTable(),
            'clusterTable' => $this->getClusterTable(),
            'serverTable' => $this->getServerTable(),
        ));
    }
    
    
    /**
     * Add credential
     */
    public function addAction()
    {
        $form = new CredentialForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $credential = new Credential\Entity();
            $form->setInputFilter($credential->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $credential->exchangeArray($form->getData());
                $this->getCredentialTable()->saveCredential($credential);

                // Redirect to list of albums
                return $this->redirect()->toRoute('credential');
            }
        }
        return array('form' => $form);
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

    /**
     * get Server TableGateway
     *
     * @return Model\Server\Table
     */
    public function getServerTable()
    {
        return $this->getServiceLocator()->get('Model\Server\Table');
    }
}
