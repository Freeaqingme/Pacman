<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Category;

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
     * Find category by id
     *
     * @param int $id
     * @return Entity
     */
    public function findCategory($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array(
            'id' => $id,
        ));
        return $rowset->current();
    }

    /*
     * fetch categories by project
     *
     * @param int $projectId
     * @return ResultSet
     */
    public function fetchByProject($projectId)
    {
        $projectId = (int) $projectId;
        $select = $this->tableGateway->getSql()->select()
            ->join('credential', "category.id = credential.category_id",array())
            ->where("credential.project_id = $projectId")
            ->group("id")
            ->order('name ASC');

        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
}
