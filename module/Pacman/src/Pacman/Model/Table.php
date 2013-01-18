<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model;

use Zend\Db\TableGateway\TableGateway;

abstract class Table
{
    /**
     * Table gateway
     * @var TableGateway
     */
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
}
