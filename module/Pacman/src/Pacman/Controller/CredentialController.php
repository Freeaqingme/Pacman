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
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id');    
        return $this->getCredentialTable()->deleteCredential($id);
        
        //@TODO Return to the overview screen immediately
        
        //@FIXME This seems like a giant workaround. I guess all we need to do is something like this;
        //$credential = new Credential($id); //Fetch a new credential entity by id, from the DB
        //$credential->delete(); //Now delete it from the DB.
        //
        // I think we'd need a simple save() and delete() function in an entity. 
        // The safe function will post an update to the database if the ID is set, 
        // and perform an insert if the ID is not set.
        // That way we could make it work like this;
        if (0==1) {
            $credential = new Credential();
            $credential->username = 'Blabla';
            echo 'Inserted under ID ' . $credential->save();
            $credential->password = 'secret';
            echo 'Saved under ID ' . $credential->save();
            $credential->delete();
        }
        //But I have no idea why this was set up so big...
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
    //@FIXME Why are these 'getProjectTable' functions in all controllers? That doens't seem right

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
