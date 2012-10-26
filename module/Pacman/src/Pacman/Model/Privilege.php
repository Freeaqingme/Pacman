<?php
namespace Pacman\Model;

class Privilege
{
    public $privilege_id;
    public $project_id;
    public $enviroment_id;
    public $permission;

    public function exchangeArray($data)
    {
        $this->privilege_id     = (isset($data['privilege_id'])) ? $data['privilege_id'] : null;
        $this->project_id  = (isset($data['project_id'])) ? $data['project_id'] : null;
        $this->enviroment_id  = (isset($data['enviroment_id'])) ? $data['enviroment_id'] : null;
        $this->permission  = (isset($data['permission'])) ? $data['permission'] : null;
    }
}