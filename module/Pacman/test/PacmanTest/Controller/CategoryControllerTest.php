<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Controller;

use Pacman\Controller\CategoryController;
use PacmanTest\Controller\AbstractControllerTest;
use Zend\Mvc\Router\RouteMatch;
use Zend\Db\ResultSet\ResultSet;

class CategoryControllerTest extends AbstractControllerTest
{
    /**
     * Test setup
     * @see PacmanTest\Controller.AbstractControllerTest::setUp()
     */
    protected function setUp()
    {
        $this->controller = new CategoryController();
        $this->routeMatch = new RouteMatch(array('controller' => 'category'));
        parent::setUp();
    }

    /**
     * Test if getCategoryTable() returns a
     * Pacman\Model\Category\CategoryTable instance
     */
    public function testGetCategoryTableReturnsAnInstanceOfCategoryTable()
    {
        //mock the model
        /*
        $resultSet        = new ResultSet();
        $mockCategoryTable = $this->getMock('Pacman\Model\Category\Table',
                                           array('fetchAll','findCategory'), array(), '', false);
        $mockCategoryTable->expects($this->once())
                         ->method('fetchAll')
                         ->will($this->returnValue($resultSet));
        $mockCategoryTable->expects($this->once())
                         ->method('findCategory')
                         ->will($this->returnValue(new \Pacman\Model\Category\Entity()));

        $sm = $this->controller->getServiceLocator();
        //overwrite categoryTable service entry
        $sm->setAllowOverride(true);
        $sm->setService('Model\Category\Table',$mockCategoryTable);
        */

        $this->assertInstanceOf(
            'Pacman\Model\Category\Table',
            $this->controller->getCategoryTable()
        );
    }

    /**
     * Test if List action can be accessed
     */
    public function testListActionCanBeAccessed()
    {
        //mock the model
        /*
        $resultSet = new ResultSet();
        $mockCategoryTable = $this->getMock('Pacman\Model\Category\Table',
                                           array('fetchAll','findCategory'), array(), '', false);
        $mockCategoryTable->expects($this->once())
                         ->method('fetchAll')
                         ->will($this->returnValue($resultSet));
        $mockCategoryTable->expects($this->once())
                         ->method('findCategory')
                         ->will($this->returnValue(new \Pacman\Model\Category\Entity()));

        $sm = $this->controller->getServiceLocator();
        //overwrite projectTable service entry
        $sm->setAllowOverride(true);
        $sm->setService('Model\Category\Table',$mockCategoryTable);
        */
        
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
