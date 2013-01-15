<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Project;

use Pacman\Model\Project\ProjectTable;
use Pacman\Model\Project\Project;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class ProjectTableTest extends PHPUnit_Framework_TestCase
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

        $projectTable = new ProjectTable($mockTableGateway);

        $this->assertSame($resultSet, $projectTable->fetchAll());
    }

    /**
     * test if findProject($id) returns a Project
     */
    public function testCanRetrieveAnProjectByItsId()
    {
        $project = new Project();
        $project->exchangeArray(array('id'     => 123,
                                    'artist' => 'The Military Wives',
                                    'title'  => 'In My Dreams'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Project());
        $resultSet->initialize(array($project));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $projectTable = new ProjectTable($mockTableGateway);

        $this->assertSame($project, $projectTable->findProject(123));
    }

    /**
     * Test if we will encounter an exception
     * when we’re trying to retrieve a Project that doesn’t exist.
     */
    public function testExceptionIsThrownWhenGettingNonexistentProject()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Project());
        $resultSet->initialize(array());

        $row_id = 123;

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => $row_id))
                         ->will($this->returnValue($resultSet));

        $projectTable = new ProjectTable($mockTableGateway);

        try
        {
            $projectTable->findProject($row_id);
        }
        catch (\Exception $e)
        {

            $this->assertSame("Could not find project with ID $row_id", $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}
