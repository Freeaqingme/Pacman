<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Controller;

use Pacman\Model\Category\Table;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController
{
    /**
     * list of categories
     */
    public function listAction()
    {
        return new ViewModel(array(
            'categories' => $this->getCategoryTable()->fetchAll(),
        ));
    }

    /**
     * Display category info by id
     */
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        $category = $this->getCategoryTable()->findCategory($id);
        if (!$category) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel(array(
            'category' => $category,
        ));
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
}
