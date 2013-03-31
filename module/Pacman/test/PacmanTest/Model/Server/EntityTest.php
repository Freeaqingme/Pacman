<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Server;

use Pacman\Model\Server\Entity;
use PHPUnit_Framework_Testcase;

class EntityTest extends PHPUnit_Framework_Testcase
{
    /**
     * test Server initinal state
     */
    public function testServerInitialState()
    {
        $server = new Entity();

        $this->assertNull($server->id, '"id" should be NULL');
        $this->assertNull($server->name, '"name" should be NULL');
        $this->assertNull($server->cluster_id, '"cluster_id" should be NULL');
    }

    /**
     * test if exchangeArray() sets the properties correctly
     */
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $server = new Entity();

        $data = array('id' => 1,
                      'name' => 'Server A',
                      'cluster_id' => 123,
                     );

        $server->exchangeArray($data);

        $this->assertSame($data['id'], $server->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $server->name, '"name" was not set correctly');
        $this->assertSame($data['cluster_id'], $server->cluster_id, '"cluster_id" was not set correctly');
    }
}
