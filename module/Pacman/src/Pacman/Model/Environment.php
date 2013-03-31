<?php
namespace Pacman\Model;

class Environment
{
    public $environment_id;
    public $name;

    public function exchangeArray($data)
    {
        $this->environment_id     = (isset($data['environment_id'])) ? $data['environment_id'] : null;
        $this->name  = (isset($data['name'])) ? $data['name'] : null;
    }
}