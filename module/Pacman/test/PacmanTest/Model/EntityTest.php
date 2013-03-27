<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model;

use Pacman\Model\Entity;
use PHPUnit_Framework_TestCase;

class EntityTest extends PHPUnit_Framework_TestCase
{
    /**
     * test __call($method, $params) with set and get
     */
    public function test__callSetAndGet()
    {
        $testValue = 'testName123';
        $entity = new testEntity();
        $entity->setName($testValue);
        $this->assertEquals($testValue, $entity->getName());
    }

    /**
     * test __call($method, $params) with set
     * and get and //protected $camelCase = false;
     */
    public function test__callSetAndGetNoCamelCase()
    {
        $entity = new test2Entity(); //protected $camelCase = false;
        $time = time();
        $entity->setinsert_ts($time);
        $this->assertEquals($time, $entity->getinsert_ts());
    }

    /**
     * Setting a property by db collumn name should should throw an Exeption
     * and hint how to use "set" instead
     */
    public function testThrowExeptionIfNoCamelcasingIsUsed()
    {
        $entity = new testEntity();
        $this->setExpectedException('Exception', 'You should set the property insert_ts using setInsertTs()');
        $entity->setinsert_ts(time());
    }

    /**
     * Setting a None Existing Property should throw an exeption
     */
    public function test_callSetNoneExistingProperty()
    {
        $entity = new testEntity();

        $this->setExpectedException('Exception', 'Invalid property was tried to set: nonexisting');
        $entity->setNonexisting('testvalue');
    }

    /**
     * Getting a None Existing Property should throw an exeption
     */
    public function test_callGetNoneExistingProperty()
    {
        $entity = new testEntity();
        $this->setExpectedException('Exception', 'Invalid key was tried to get: nonexisting');
        $entity->getNonexisting();
    }

    /**
     * Test exchangeArray and getProperties functions
     */
    public function testExchangeArrayAndGetProperties()
    {
        $entity = new testEntity();

        $values = array(
            'id' => PHP_INT_MAX,
            'name' => 'testname',
            'insert_ts' => time(),
        );

        $entity->exchangeArray($values);

        $returnValues = $entity->getProperties();
        $this->assertEquals($values, $returnValues);
    }
}

class testEntity extends Entity
{
    /**
     * Entity properties
     * @var array
     */
    protected $_properties = array(
        'id' => null,
        'name' => null,
        'insert_ts' => null,
    );
}

class test2Entity extends testEntity
{
    protected $camelCase = false;
}