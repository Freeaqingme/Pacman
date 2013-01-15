<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Category;

use Pacman\Model\Category\CategoryTable;
use Pacman\Model\Category\Category;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class CategoryTableTest extends PHPUnit_Framework_TestCase
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

        $categoryTable = new CategoryTable($mockTableGateway);

        $this->assertSame($resultSet, $categoryTable->fetchAll());
    }

    /**
     * test if findCategory($id) returns a Category
     */
    public function testCanRetrieveAnCategoryByItsId()
    {
        $category = new Category();
        $category->exchangeArray(array('id'     => 123,
                                       'name' => 'MySQL',
                                 ));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Category());
        $resultSet->initialize(array($category));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $categoryTable = new CategoryTable($mockTableGateway);

        $this->assertSame($category, $categoryTable->findCategory(123));
    }

    /**
     * Test if we will encounter an exception
     * when we’re trying to retrieve a Category that doesn’t exist.
     */
    public function testExceptionIsThrownWhenGettingNonexistentCategory()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Category());
        $resultSet->initialize(array());

        $row_id = 123;

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => $row_id))
                         ->will($this->returnValue($resultSet));

        $categoryTable = new CategoryTable($mockTableGateway);

        try
        {
            $categoryTable->findCategory($row_id);
        }
        catch (\Exception $e)
        {

            $this->assertSame("Could not find category with ID $row_id", $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}
