<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Credential;

use Pacman\Model\Credential\Table;
use Pacman\Model\Credential\Entity;
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

        $credentialTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $credentialTable->fetchAll());
    }

    /**
     * test if findCredential($id) returns a Credential
     */
    public function testCanRetrieveCredentialByItsId()
    {
        $project = new Entity();
        $project->exchangeArray(array(
            'id' => 123,
            'project_id' => 1,
            'category_id' => 2,
            'cluster_id' => 3,
            'server_id' => 4,
            'notes' => 'Just for uploading to import/customerfiles',
            'url' => 'ftp://testdomain.com',
            'username' => 'testuser',
            'password' => 'testpassword',
        ));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Entity());
        $resultSet->initialize(array($project));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $credentialTable = new Table($mockTableGateway);

        $this->assertSame($project, $credentialTable->findCredential(123));
    }

    /**
     * Test if findCredential($id) returns null
     * when we’re trying to retrieve a Credential that doesn’t exist.
     */
    public function testCannotRetrieveCredentialByItsId()
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

        $credentialTable = new Table($mockTableGateway);

        $this->assertNull($credentialTable->findCredential($row_id));
    }

    /**
     * test if fetchByProjectAndCategory() returns a ResultSet object.
     */
    public function testfetchByProjectAndCategoryReturnsResultset()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array(
                            'project_id' => 123,
                            'category_id' => 2,
                         ))
                         ->will($this->returnValue($resultSet));

        $credentialTable = new Table($mockTableGateway);

        $this->assertSame($resultSet, $credentialTable->fetchByProjectAndCategory(123,2));
    }
}
