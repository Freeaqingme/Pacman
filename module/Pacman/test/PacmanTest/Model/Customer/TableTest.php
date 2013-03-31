<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Customer;

use Pacman\Model\Customer\Table;
use Pacman\Model\Customer\Entity;
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

        $customerTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $customerTable->fetchAll());
    }

    /**
     * test if findCustomer($id) returns a Customer
     */
    public function testCanRetrieveAnCustomerByItsId()
    {
        $customer = new Entity();
        $customer->exchangeArray(array('id'     => 123,
                                       'name' => 'MySQL',
                                 ));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Entity());
        $resultSet->initialize(array($customer));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $customerTable = new Table($mockTableGateway);

        $this->assertSame($customer, $customerTable->findCustomer(123));
    }

    /**
     * Test if findCustomer($id) returns null
     * when we’re trying to retrieve a Project that doesn’t exist.
     */
    public function testCannotRetrieveCustomerByItsId()
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

        $customerTable = new Table($mockTableGateway);

        $this->assertNull($customerTable->findCustomer($row_id));
    }
}
