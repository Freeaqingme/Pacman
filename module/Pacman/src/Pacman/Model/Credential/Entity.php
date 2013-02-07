<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Credential;

use Pacman\Model\Entity as EntityAbstract;

class Entity extends EntityAbstract
{
    /**
     * Credential properties
     * @var array
     */
    protected $_properties = array(
            'id' => null,
            'project_id' => null,
            'category_id' => null,
            'notes' => null,
            'url' => null,
            'username' => null,
            'password' => null,
    );
}
