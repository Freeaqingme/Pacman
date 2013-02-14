<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
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
            'Pacman\Model\Project\Table',
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
     * Test if List action returns correct value
     */
    public function testListActionCorrectReturnValue()
    {
        $returnValue = $this->controller->listAction();

        // Check for a ViewModel to be returned
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $returnValue);

        // Test the parameters contained in the View model
        $viewModelVars = $returnValue->getVariables();
        $this->assertCount(1, $viewModelVars);
        $this->assertArrayHasKey('projects', $viewModelVars);
        $this->assertInstanceOf('Zend\Db\ResultSet\ResultSet', $viewModelVars['projects']);
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
     * Test if View action returns correct value
     */
    public function testViewActionCorrectReturnValue()
    {
        $this->routeMatch->setParam('id', '1');
        $returnValue = $this->controller->viewAction();

        // Check for a ViewModel to be returned
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $returnValue);

        // Test the parameters contained in the View model
        $viewModelVars = $returnValue->getVariables();
        $this->assertCount(6, $viewModelVars);

        $this->assertArrayHasKey('project', $viewModelVars);
        $this->assertArrayHasKey('categories', $viewModelVars);
        $this->assertArrayHasKey('credentialTable', $viewModelVars);
        $this->assertArrayHasKey('environmentTable', $viewModelVars);
        $this->assertArrayHasKey('clusterTable', $viewModelVars);
        $this->assertArrayHasKey('serverTable', $viewModelVars);

        $this->assertInstanceOf('Pacman\Model\Project\Entity', $viewModelVars['project']);
        $this->assertInstanceOf('Zend\Db\ResultSet\ResultSet', $viewModelVars['categories']);
        $this->assertInstanceOf('Pacman\Model\Credential\Table', $viewModelVars['credentialTable']);
        $this->assertInstanceOf('Pacman\Model\Cluster\Table', $viewModelVars['clusterTable']);
        $this->assertInstanceOf('Pacman\Model\Server\Table', $viewModelVars['serverTable']);
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
