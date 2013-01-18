<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Project;

use Pacman\Model\Project\Entity;
use PHPUnit_Framework_Testcase;

class EntityTest extends PHPUnit_Framework_Testcase
{
    /**
     * test Project initinal state
     */
    public function testProjectInitialState()
    {
        $entity = new Entity();

        $this->assertNull($entity->id, '"id" should be NULL');
        $this->assertNull($entity->name, '"name" should be NULL');
        $this->assertNull($entity->description, '"description" should be NULL');
    }

    /**
     * test if exchangeArray() sets the properties correctly
     */
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $entity = new Entity();

        $data = array(
            'id' => 123,
            'name' => 'Project X',
            'description' => 'Test description',
            'url' => 'http://www.test.net',
        );

        $entity->exchangeArray($data);

        $this->assertSame($data['id'], $entity->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $entity->name, '"name" was not set correctly');
        $this->assertSame($data['description'], $entity->description, '"description" was not set correctly');
        $this->assertSame($data['url'], $entity->url, '"description" was not set correctly');
    }
}
