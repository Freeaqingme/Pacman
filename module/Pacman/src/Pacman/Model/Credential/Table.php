<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Credential;

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
     * Find credential by id
     *
     * @param int $id
     * @return Entity
     */
    public function findCredential($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array(
            'id' => $id,
        ));

        return $rowset->current();
    }

    /**
     * Fetch passwords by Project and Category
     *
     * @param int $projectId
     * @param int $categoryId
     * @return ResultSet
     */
    public function fetchByProjectAndCategory($projectId,$categoryId)
    {
        $projectId = (int) $projectId;
        $categoryId = (int) $categoryId;

        return $this->tableGateway->select(array(
                'project_id' => $projectId,
                'category_id' => $categoryId,
            ));
    }
}
