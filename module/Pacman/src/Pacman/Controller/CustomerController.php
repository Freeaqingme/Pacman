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

class CustomerController extends AbstractActionController
{
    /**
     * list of customers
     */
    public function listAction()
    {
        return new ViewModel(array(
            'customers' => $this->getCustomerTable()->fetchAll(),
        ));
    }

    /**
     * Display Customer info by id
     */
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        $customer = $this->getCustomerTable()->findCustomer($id);
        if (!$customer) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel(array(
            'customer' => $customer,
            'projects' => $this->getProjectTable()->fetchByCustomerId($customer->id),
        ));
    }

    /**
     * get Customer TableGateway
     *
     * @return Model\Customer\Table
     */
    public function getCustomerTable()
    {
        return $this->getServiceLocator()->get('Model\Customer\Table');
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
