<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProjectController extends AbstractActionController
{
	protected $projectTable;

    public function indexAction()
    {
        return new ViewModel(array(
			'projects' => $this->getProjectTable()->fetchLatest(),
		));
    }
	
	public function viewAction()
    {
		return new ViewModel();
    }
	
	public function getProjectTable()
	{
		if (!$this->projectTable) {
			$sm = $this->getServiceLocator();
			$this->projectTable = $sm->get('Pacman\Module\ProjectTable');
		}
		return $this->projectTable;
	}
}
