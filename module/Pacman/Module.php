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
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap($e)
    {
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
                'Model\Project\Table' => function($sm) {
                    $tableGateway = Module::getTableGateway($sm, 'project', 'Model\Project\Entity');
                    return new Model\Project\Table($tableGateway);
                },
                'Model\Category\Table' => function($sm) {
                    $tableGateway = Module::getTableGateway($sm, 'category', 'Model\Category\Entity');
                    return new Model\Category\Table($tableGateway);
                },
                'Model\Environment\Table' => function($sm) {
                    $tableGateway = Module::getTableGateway($sm, 'environment', 'Model\Environment\Entity');
                    return new Model\Environment\Table($tableGateway);
                },
                'Model\Customer\Table' => function($sm) {
                    $tableGateway = Module::getTableGateway($sm, 'customer', 'Model\Customer\Entity');
                    return new Model\Customer\Table($tableGateway);
                },
                'Model\Credential\Table' => function($sm) {
                    $tableGateway = Module::getTableGateway($sm, 'credential', 'Model\Credential\Entity');
                    return new Model\Credential\Table($tableGateway);
                },
                'Model\Cluster\Table' => function($sm) {
                    $tableGateway = Module::getTableGateway($sm, 'cluster', 'Model\Cluster\Entity');
                    return new Model\Cluster\Table($tableGateway);
                },
                'Model\Server\Table' => function($sm) {
                    $tableGateway = Module::getTableGateway($sm, 'server', 'Model\Server\Entity');
                    return new Model\Server\Table($tableGateway);
                },
            ),
        );
    }

    static public function getTableGateway($sm, $tableName, $entityName)
    {
        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new ResultSet();
        $entityName = 'Pacman\\' . $entityName;
        $resultSetPrototype->setArrayObjectPrototype(new $entityName());
        return new TableGateway($tableName, $dbAdapter, null, $resultSetPrototype);
    }
}
