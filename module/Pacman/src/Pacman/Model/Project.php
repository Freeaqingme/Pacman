<?php
namespace Pacman\Model;

class Project
{
    public $project_id;
    public $name;
    public $description;

    public function exchangeArray($data)
    {
        $this->project_id     = (isset($data['project_id'])) ? $data['project_id'] : null;
        $this->name  = (isset($data['name'])) ? $data['name'] : null;
        $this->description  = (isset($data['description'])) ? $data['description'] : null;
    }
}