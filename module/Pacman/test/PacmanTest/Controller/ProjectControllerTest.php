<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @author Rob Quist ()
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Controller;

use Pacman\Controller\ProjectController;
use PacmanTest\Controller\AbstractControllerTest;
use Zend\Mvc\Router\RouteMatch;

class ProjectControllerTest extends AbstractControllerTest
{
    /**
     * Test setup
     * @see PacmanTest\Controller.AbstractControllerTest::setUp()
     */
    protected function setUp()
    {
        $this->controller = new ProjectController();
        $this->routeMatch = new RouteMatch(array('controller' => 'project'));
        parent::setUp();
    }

    /**
     * Test if getProjectTable() returns a
     * Pacman\Model\Project\ProjectTable instance
     */
    public function testGetProjectTableReturnsAnInstanceOfProjectTable()
    {
        $this->assertInstanceOf(
            'Pacman\Model\Project\ProjectTable',
            $this->controller->getProjectTable()
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
