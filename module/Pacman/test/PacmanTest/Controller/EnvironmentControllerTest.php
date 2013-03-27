<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Controller;

use Pacman\Controller\EnvironmentController;
use PacmanTest\Controller\AbstractControllerTest;
use Zend\Mvc\Router\RouteMatch;

class EnvironmentControllerTest extends AbstractControllerTest
{
    /**
     * Test setup
     * @see PacmanTest\Controller.AbstractControllerTest::setUp()
     */
    protected function setUp()
    {
        $this->controller = new EnvironmentController();
        $this->routeMatch = new RouteMatch(array('controller' => 'environment'));
        parent::setUp();
    }

    /**
     * Test if getEnvironmentTable() returns a
     * Pacman\Model\Environment\EnvironmentTable instance
     */
    public function testGetEnvironmentTableReturnsAnInstanceOfEnvironmentTable()
    {
        $this->assertInstanceOf(
            'Pacman\Model\Environment\Table',
            $this->controller->getEnvironmentTable()
        );
    }

    /**
     * Test if List action can be accessed
     */
    public function testListActionCanBeAccessed()
    {
        $this->assertActionCanBeAccessed('list');
    }

    /**
     * Test if View action can be accessed
     */
    public function testViewActionCanBeAccessed()
    {
        $this->routeMatch->setParam('id', '1');
        $this->assertActionCanBeAccessed('view');
    }

    /**
     * Test if View action can't be found with no id param
     */
    public function testViewActionNotFound()
    {
        $this->routeMatch->setParam('action', 'view');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
    }

}
