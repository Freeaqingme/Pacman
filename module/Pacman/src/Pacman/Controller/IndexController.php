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

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $modelName = $this->AcceptantViewModelSelector(
                array('Zend\View\Model\JsonModel' => 'application/json',
                      'Zend\View\Model\FeedModel' => array('application/rss+xml',
                                                           'application/atom+xml'),
                      'Zend\View\Model\ViewModel' => '*/*'));
        return new $modelName();
    }
}
