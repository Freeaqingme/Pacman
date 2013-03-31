<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Project;

use Pacman\Model\Entity as EntityAbstract;

class Entity extends EntityAbstract
{
    /**
     * Project properties
     * @var array
     */
    protected $_properties = array(
            'id' => null,
            'name' => null,
            'description' => null,
            'url' => null,
            'customer_id' => null,
    );
}
