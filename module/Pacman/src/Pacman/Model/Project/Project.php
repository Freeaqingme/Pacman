<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Project;

class Project
{
    /**
     * Primary Key
     * @var int
     */
    public $id;

    /**
     * Project name
     * @var String
     */
    public $name;

    /**
     * Project description
     * @var String
     */
    public $description;

    /**
     * Project url
     * @var String
     */
    public $url;

    /**
     * Populate Entity Properties
     * @param array $data
     */
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->url = (isset($data['url'])) ? $data['url'] : null;
    }
}
