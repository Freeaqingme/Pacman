<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Customer;

use Pacman\Model\Customer\Entity;
use PHPUnit_Framework_Testcase;

class EntityTest extends PHPUnit_Framework_Testcase
{
    /**
     * test Customer initinal state
     */
    public function testCustomerInitialState()
    {
        $customer = new Entity();

        $this->assertNull($customer->id, '"id" should be NULL');
        $this->assertNull($customer->name, '"name" should be NULL');
    }

    /**
     * test if exchangeArray() sets the properties correctly
     */
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $customer = new Entity();

        $data = array('id' => 1,
                      'name' => 'A Customer',
                     );

        $customer->exchangeArray($data);

        $this->assertSame($data['id'], $customer->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $customer->name, '"name" was not set correctly');
    }
}
