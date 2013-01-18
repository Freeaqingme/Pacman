<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model;

use Pacman\Model\Table;

use PHPUnit_Framework_TestCase;

class TableTest extends PHPUnit_Framework_TestCase
{
    /**
     * test __construct(TableGateway $tableGateway)
     */
    public function testConstruct()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array(), array(), '', false);
        $table = new testTable($mockTableGateway);

        //check if tableGateway has been set correctly
        $this->assertAttributeInstanceOf('Zend\Db\TableGateway\TableGateway', 'tableGateway', $table);
    }
}

/*
 * Class definition of abstract class Pacman\Model\Table
 */
class testTable extends Table
{
}
