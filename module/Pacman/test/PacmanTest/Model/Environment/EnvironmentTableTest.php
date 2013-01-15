<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Environment;

use Pacman\Model\Environment\EnvironmentTable;
use Pacman\Model\Environment\Environment;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class EnvironmentTableTest extends PHPUnit_Framework_TestCase
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
                         ->with()
                         ->will($this->returnValue($resultSet));

        $environmentTable = new EnvironmentTable($mockTableGateway);

        $this->assertSame($resultSet, $environmentTable->fetchAll());
    }

    /**
     * test if findEnvironment($id) returns a Environment
     */
    public function testCanRetrieveAnEnvironmentByItsId()
    {
        $environment = new Environment();
        $environment->exchangeArray(array('id'     => 123,
                                       'name' => 'Production',
                                 ));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Environment());
        $resultSet->initialize(array($environment));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $environmentTable = new EnvironmentTable($mockTableGateway);

        $this->assertSame($environment, $environmentTable->findEnvironment(123));
    }

    /**
     * Test if we will encounter an exception
     * when we’re trying to retrieve a Environment that doesn’t exist.
     */
    public function testExceptionIsThrownWhenGettingNonexistentEnvironment()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Environment());
        $resultSet->initialize(array());

        $row_id = 123;

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => $row_id))
                         ->will($this->returnValue($resultSet));

        $environmentTable = new EnvironmentTable($mockTableGateway);

        try
        {
            $environmentTable->findEnvironment($row_id);
        }
        catch (\Exception $e)
        {

            $this->assertSame("Could not find environment with ID $row_id", $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}
