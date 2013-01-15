<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Environment;

use Pacman\Model\Environment\Environment;
use PHPUnit_Framework_Testcase;

class EnvironmentTest extends PHPUnit_Framework_Testcase
{
    /**
     * test Environment initinal state
     */
    public function testEnvironmentInitialState()
    {
        $environment = new Environment();

        $this->assertNull($environment->id, '"id" should be NULL');
        $this->assertNull($environment->name, '"name" should be NULL');
    }

    /**
     * test if exchangeArray() sets the properties correctly
     */
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $environment = new Environment();

        $data = array('id' => 1,
                      'name' => 'Test',
                     );

        $environment->exchangeArray($data);

        $this->assertSame($data['id'], $environment->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $environment->name, '"name" was not set correctly');
    }

    /**
     * test if exchangeArray() defaults the properties correctly
     */
    public function testExchangeArraySetsPropertiesToNull()
    {
        $environment = new Environment();

        $data = array('id' => 1,
                      'name' => 'Test',
                     );

        $environment->exchangeArray($data);

        $environment->exchangeArray(array());

        $this->assertNull($environment->id, '"id" should have defaulted to null');
        $this->assertNull($environment->name, '"name" should have defaulted to null');
    }
}
