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
    }

    /**
     * Test if Index action can be accessed
     */
    public function testIndexActionCanBeAccessed()
    {
        $this->assertActionCanBeAccessed('index');
    }
}
