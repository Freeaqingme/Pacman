<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Server;

use Pacman\Model\Server\Table;
use Pacman\Model\Server\Entity;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class TableTest extends PHPUnit_Framework_TestCase
{
    /**
     * test if fetchAll() returns a ResultSet object.
     */
    public function testFetchAllReturnsResultset()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->will($this->returnValue($resultSet));

        $serverTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $serverTable->fetchAll());
    }

    /**
     * test if findServer($id) returns a Server
     */
    public function testCanRetrieveAnServerByItsId()
    {
        $server = new Entity();
        $server->exchangeArray(array('id'     => 123,
                                     'name' => 'Server A',
                                     'cluster_id' => 1,
                                 ));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Entity());
        $resultSet->initialize(array($server));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $serverTable = new Table($mockTableGateway);

        $this->assertSame($server, $serverTable->findServer(123));
    }

    /**
     * Test if findServer($id) returns null
     * when we’re trying to retrieve a Project that doesn’t exist.
     */
    public function testCannotRetrieveServerByItsId()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Entity());
        $resultSet->initialize(array());

        $row_id = 123;

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => $row_id))
                         ->will($this->returnValue($resultSet));

        $serverTable = new Table($mockTableGateway);

        $this->assertNull($serverTable->findServer($row_id));
    }
}
