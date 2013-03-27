<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Cluster;

use Pacman\Model\Cluster\Table;
use Pacman\Model\Cluster\Entity;
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

        $clusterTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $clusterTable->fetchAll());
    }

    /**
     * test if findCluster($id) returns a Cluster
     */
    public function testCanRetrieveAnClusterByItsId()
    {
        $cluster = new Entity();
        $cluster->exchangeArray(array('id'     => 123,
                                       'name' => 'Cluster A',
                                 ));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Entity());
        $resultSet->initialize(array($cluster));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $clusterTable = new Table($mockTableGateway);

        $this->assertSame($cluster, $clusterTable->findCluster(123));
    }

    /**
     * Test if findCluster($id) returns null
     * when we’re trying to retrieve a Project that doesn’t exist.
     */
    public function testCannotRetrieveClusterByItsId()
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

        $clusterTable = new Table($mockTableGateway);

        $this->assertNull($clusterTable->findCluster($row_id));
    }
}
