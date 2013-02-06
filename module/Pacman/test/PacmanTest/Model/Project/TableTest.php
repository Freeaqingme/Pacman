<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Project;

use Pacman\Model\Project\Table;
use Pacman\Model\Project\Entity;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
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

        $projectTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $projectTable->fetchAll());
    }

    /**
     * test if fetchLatest($limit = 5) returns a ResultSet object.
     */
    public function testFetchLatestReturnsResultset()
    {
        $resultSet = new ResultSet();

        $mockSql = $this->getMock('Zend\Db\Sql\Sql',array('select'),
                                  array(), '', false);
        $mockSql->expects($this->once())
                         ->method('select')
                         ->will($this->returnValue(new Select()));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('getSql','selectWith'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('getSql')
                         ->will($this->returnValue($mockSql));
        $mockTableGateway->expects($this->once())
                         ->method('selectWith')
                         ->will($this->returnValue($resultSet));

        $projectTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $projectTable->fetchLatest());
    }

    /**
     * test if findProject($id) returns a Project
     */
    public function testCanRetrieveProjectByItsId()
    {
        $project = new Entity();
        $project->exchangeArray(array(
            'id' => 123,
            'name' => 'Project X',
            'description' => 'Test description',
            'url' => 'http://www.test.net',
        ));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Entity());
        $resultSet->initialize(array($project));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $projectTable = new Table($mockTableGateway);

        $this->assertSame($project, $projectTable->findProject(123));
    }

    /**
     * Test if findProject($id) returns null
     * when we’re trying to retrieve a Project that doesn’t exist.
     */
    public function testCannotRetrieveProjectByItsId()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Entity());
        $resultSet->initialize(array());

        $row_id = 123;

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => $row_id))
                         ->will($this->returnValue($resultSet));

        $projectTable = new Table($mockTableGateway);

        $this->assertNull($projectTable->findProject($row_id));
    }

    /**
     * test if fetchByCustomerId() returns a ResultSet object.
     */
    public function testfetchByCustomerIdReturnsResultset()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('customer_id' => 123))
                         ->will($this->returnValue($resultSet));

        $projectTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $projectTable->fetchByCustomerId(123));
    }
}
