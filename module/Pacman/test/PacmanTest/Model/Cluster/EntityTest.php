<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Cluster;

use Pacman\Model\Cluster\Entity;
use PHPUnit_Framework_Testcase;

class EntityTest extends PHPUnit_Framework_Testcase
{
    /**
     * test Cluster initinal state
     */
    public function testClusterInitialState()
    {
        $cluster = new Entity();

        $this->assertNull($cluster->id, '"id" should be NULL');
        $this->assertNull($cluster->name, '"name" should be NULL');
    }

    /**
     * test if exchangeArray() sets the properties correctly
     */
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $cluster = new Entity();

        $data = array('id' => 1,
                      'name' => 'Cluster A',
                     );

        $cluster->exchangeArray($data);

        $this->assertSame($data['id'], $cluster->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $cluster->name, '"name" was not set correctly');
    }
}
