<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Project;


use Pacman\Model\Project\Project;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql;

class ProjectTable
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

    /**
     * Fetch all
     *
     * @return ResultSet
     */
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * Fetch latest 5
     *
     * @return ResultSet
     */
    public function fetchLatest()
    {
        $select = $this->tableGateway->getSql()->select();
        $select->order('id DESC')->limit(5);

        return $this->tableGateway->selectWith($select);
    }

    /**
     * Find project by id
     *
     * @param int $id
     * @return Entity
     */
    public function findProject($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array(
            'id' => $id,
        ));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find project with ID $id");
        }

        return $row;
    }
}
