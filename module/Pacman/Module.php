<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman;

use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\ModuleManager;
use \Zend\Mvc\MvcEvent;

use Pacman\Model\ProjectTable;
use Pacman\Model\EnvironmentTable;

class Module
{
    public function onBootstrap($e)
    {
        error_reporting(E_ALL);
        ini_set('display_errors',1);
                
        $e->getApplication()->getServiceManager()->get('translator');
        $em                  = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($em);

        $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'redirectUnauthedUsersEvent'));
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }


    public function redirectUnauthedUsersEvent(MvcEvent $e)
    {
        $matches      = $e->getRouteMatch();
        $controller   = $matches->getParam('controller');
        $action       = $matches->getParam('action', 'index');

        $sm = $e->getApplication()->getServiceManager();

        $auth = $sm->get('zfcuser_auth_service');
        if ($auth->hasIdentity()) {
            return;
        }

        //@TODO: How do we get module here as well?
        if ($controller == 'zfcuser' && ($action == 'register') || $action == 'login') {
            
            //var_dump($auth);
            
            return null;
        }

        /** @var $response \Zend\Http\PhpEnvironment\Response */
        $response = $e->getResponse();
        if ($response instanceof \Zend\Http\Response) {
            $response->getHeaders()->addHeaderLine('Location', '/user/login');
            $response->setStatusCode(307);

        }

        return $response;
    }
	
	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'Pacman\Module\ProjectTable' => function($sm) {
					$dbAdapter	=	$sm->get('Zend\Db\Adapter\Adapter');
					$table		=	new ProjectTable($dbAdapter);
					return $table;
				},
                'Pacman\Module\EnvironmentTable' => function($sm) {
					$dbAdapter	        =	$sm->get('Zend\Db\Adapter\Adapter');
					$environmentTable	=	new EnvironmentTable($dbAdapter);
					return $environmentTable;
				},
			),
		);
	}
}
