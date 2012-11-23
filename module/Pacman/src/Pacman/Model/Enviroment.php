<?php
namespace Pacman\Model;

class Enviroment
{
    public $enviroment_id;
    public $name;

    public function exchangeArray($data)
    {
        $this->enviroment_id     = (isset($data['enviroment_id'])) ? $data['enviroment_id'] : null;
        $this->name  = (isset($data['name'])) ? $data['name'] : null;
    }
}