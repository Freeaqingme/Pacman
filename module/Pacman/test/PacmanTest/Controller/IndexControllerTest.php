<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Controller;

use Pacman\Controller\IndexController;
use PacmanTest\Controller\AbstractControllerTest;
use Zend\Mvc\Router\RouteMatch;
use Zend\Db\ResultSet\ResultSet;
use PacmanTest\Bootstrap;

class IndexControllerTest extends AbstractControllerTest
{

    /**
     * Test setup
     * @see PacmanTest\Controller.AbstractControllerTest::setUp()
     */
    protected function setUp()
    {
        $this->controller = new IndexController();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        parent::setUp();

        //mock the model
        $resultSet        = new ResultSet();
        $mockProjectTable = $this->getMock('Pacman\Model\Project\Table',
                                           array('fetchLatest'), array(), '', false);
        $mockProjectTable->expects($this->once())
                         ->method('fetchLatest')
                         ->will($this->returnValue($resultSet));

        $sm = $this->controller->getServiceLocator();
        //overwrite projectTable service entry
        $sm->setAllowOverride(true);
        $sm->setService('Model\Project\Table',$mockProjectTable);
    }

    /**
     * Test if Index action can be accessed
     */
    public function testIndexActionCanBeAccessed()
    {
        $this->assertActionCanBeAccessed('index');
    }

    /**
     * Test if Index Action returns correct value
     */
    public function testIndexActionCorrectReturnValue()
    {
        $returnValue = $this->controller->indexAction();

        // Check for a ViewModel to be returned
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $returnValue);

        // Test the parameters contained in the View model
        $viewModelVars = $returnValue->getVariables();
        $this->assertCount(1, $viewModelVars);
        $this->assertArrayHasKey('projects', $viewModelVars);
        $this->assertInstanceOf('Zend\Db\ResultSet\ResultSet', $viewModelVars['projects']);
    }


}
