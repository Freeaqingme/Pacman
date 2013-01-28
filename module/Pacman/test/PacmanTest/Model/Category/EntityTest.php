<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Category;

use Pacman\Model\Category\Entity;
use PHPUnit_Framework_Testcase;

class EntityTest extends PHPUnit_Framework_Testcase
{
    /**
     * test Category initinal state
     */
    public function testCategoryInitialState()
    {
        $category = new Entity();

        $this->assertNull($category->id, '"id" should be NULL');
        $this->assertNull($category->name, '"name" should be NULL');
    }

    /**
     * test if exchangeArray() sets the properties correctly
     */
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $category = new Entity();

        $data = array('id' => 1,
                      'name' => 'MySQL',
                     );

        $category->exchangeArray($data);

        $this->assertSame($data['id'], $category->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $category->name, '"name" was not set correctly');
    }
}
