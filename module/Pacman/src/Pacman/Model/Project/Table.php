<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Project;

use Pacman\Model\Table as TableAbstract;

class Table extends TableAbstract
{
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
     * Fetch latest
     *
     * @return ResultSet
     */
    public function fetchLatest($limit = 5)
    {
        $limit  = (int) $limit;
        $select = $this->tableGateway->getSql()->select();
        $select->order('id DESC')->limit($limit);

        return $this->tableGateway->selectWith($select);
    }

    /**
     * Fetch by customer id
     *
     * @return ResultSet
     */
    public function fetchByCustomerId($customerId)
    {
        $customerId  = (int) $customerId;

        return $this->tableGateway->select(array(
            'customer_id' => $customerId,
        ));
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
        return $rowset->current();
    }
}
