<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Credential;

use Pacman\Model\Credential\Entity;
use PHPUnit_Framework_Testcase;

class EntityTest extends PHPUnit_Framework_Testcase
{
    /**
     * test Credential initinal state
     */
    public function testCredentialInitialState()
    {
        $entity = new Entity();

        $this->assertNull($entity->id, '"id" should be NULL');
        $this->assertNull($entity->project_id, '"project_id" should be NULL');
        $this->assertNull($entity->category_id, '"category_id" should be NULL');
        $this->assertNull($entity->notes, '"notes" should be NULL');
        $this->assertNull($entity->url, '"url" should be NULL');
        $this->assertNull($entity->username, '"username" should be NULL');
        $this->assertNull($entity->password, '"password" should be NULL');
    }

    /**
     * test if exchangeArray() sets the properties correctly
     */
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $entity = new Entity();

        $data = array(
            'id' => 123,
            'project_id' => 1,
            'category_id' => 2,
            'notes' => 'Just for uploading to import/customerfiles',
            'url' => 'ftp://testdomain.com',
            'username' => 'testuser',
            'password' => 'testpassword',
        );

        $entity->exchangeArray($data);

        $this->assertSame($data['id'], $entity->id, '"id" was not set correctly');
        $this->assertSame($data['project_id'], $entity->projectId, '"project_id" was not set correctly');
        $this->assertSame($data['category_id'], $entity->categoryId, '"category_id" was not set correctly');
        $this->assertSame($data['notes'], $entity->notes, '"notes" was not set correctly');
        $this->assertSame($data['url'], $entity->url, '"description" was not set correctly');
        $this->assertSame($data['username'], $entity->username, '"username" was not set correctly');
        $this->assertSame($data['password'], $entity->password, '"password" was not set correctly');
    }
}
