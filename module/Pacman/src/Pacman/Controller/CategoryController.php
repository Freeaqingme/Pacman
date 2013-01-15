<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @author Rob Quist ()
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Controller;

use Pacman\Model\Category\CategoryTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController
{
    protected $categoryTable;

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
        $id = (int) $this->params()->fromRoute('id', 0);

        try {
            $category = $this->getCategoryTable()->findCategory($id);
        } catch (\Exception $e) {
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
     * @return CategoryTable
     */
    public function getCategoryTable()
    {
        if (!$this->categoryTable) {
            $sm = $this->getServiceLocator();
            $this->categoryTable = $sm->get('Pacman\Model\Category\CategoryTable');
        }
        return $this->categoryTable;
    }
}
