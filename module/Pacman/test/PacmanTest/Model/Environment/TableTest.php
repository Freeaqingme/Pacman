<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Environment;

use Pacman\Model\Environment\Table;
use Pacman\Model\Environment\Entity;
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

        $environmentTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $environmentTable->fetchAll());
    }

    /**
     * test if findEnvironment($id) returns a Environment
     */
    public function testCanRetrieveAnEnvironmentByItsId()
    {
        $environment = new Entity();
        $environment->exchangeArray(array('id' => 123,
                                          'name' => 'Production',
                                 ));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Entity());
        $resultSet->initialize(array($environment));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $environmentTable = new Table($mockTableGateway);

        $this->assertSame($environment, $environmentTable->findEnvironment(123));
    }

    /**
     * Test if we will encounter an exception
     * when we’re trying to retrieve a Environment that doesn’t exist.
     */
    public function testCannotRetrieveEnvironmentByItsId()
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

        $environmentTable = new Table($mockTableGateway);

        $this->assertNull($environmentTable->findEnvironment($row_id));
    }

    /**
     * test if fetchByCredential() returns a ResultSet object.
     */
    public function testfetchByCredentialReturnsResultset()
    {
        $resultSet = new ResultSet();

        $mockSelect = $this->getMock('Zend\Db\Sql\Select',array('join','where','order'), array(), '', false);
        $mockSelect->expects($this->once())
                   ->method('join')
                   ->will($this->returnValue($mockSelect));
        $mockSelect->expects($this->once())
                   ->method('where')
                   ->will($this->returnValue($mockSelect));
        $mockSelect->expects($this->once())
                   ->method('order')
                   ->will($this->returnValue($mockSelect));

        $mockSql = $this->getMock('Zend\Db\Sql\Sql',array('select'), array(), '', false);
        $mockSql->expects($this->once())
                ->method('select')
                ->will($this->returnValue($mockSelect));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('getSql','selectWith'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('getSql')
                         ->will($this->returnValue($mockSql));
        $mockTableGateway->expects($this->once())
                         ->method('selectWith')
                         ->with($mockSelect)
                         ->will($this->returnValue($resultSet));

        $environmentTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $environmentTable->fetchByCredential(123));
    }
}

