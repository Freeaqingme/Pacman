<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @author Rob Quist ()
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PacmanTest\Model\Project;

use Pacman\Model\Project\Project;
use PHPUnit_Framework_Testcase;

class ProjectTest extends PHPUnit_Framework_Testcase
{
    /**
     * test Project initinal state
     */
    public function testProjectInitialState()
    {
        $project = new Project();

        $this->assertNull($project->id, '"id" should be NULL');
        $this->assertNull($project->name, '"name" should be NULL');
        $this->assertNull($project->description, '"description" should be NULL');
    }

    /**
     * test if exchangeArray() sets the properties correctly
     */
    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $project = new Project();

        $data = array('id' => 1,
                      'name' => 'Project X',
                      'description' => 'Test description',
                     );

        $project->exchangeArray($data);

        $this->assertSame($data['id'], $project->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $project->name, '"name" was not set correctly');
        $this->assertSame($data['description'], $project->description, '"description" was not set correctly');
    }

    /**
     * test if exchangeArray() defaults the properties correctly
     */
    public function testExchangeArraySetsPropertiesToNull()
    {
        $project = new Project();

        $data = array('id' => 1,
                      'name' => 'Project X',
                      'description' => 'Test description',
                     );

        $project->exchangeArray($data);

        $project->exchangeArray(array());

        $this->assertNull($project->id, '"id" should have defaulted to null');
        $this->assertNull($project->name, '"name" should have defaulted to null');
        $this->assertNull($project->description, '"description" should have defaulted to null');
    }
}
