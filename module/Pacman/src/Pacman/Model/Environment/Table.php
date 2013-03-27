<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Environment;

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
     * Find environment by id
     *
     * @param int $id
     * @return Entity
     */
    public function findEnvironment($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array(
            'id' => $id,
        ));
        return $rowset->current();
    }

    /**
     * Fetch Environments by credential
     *
     * @param int $credentialId
     * @return Entity
     */
    public function fetchByCredential($credentialId)
    {
        $credentialId = (int) $credentialId;
        $select = $this->tableGateway->getSql()->select()
            ->join('credential_environment', "environment.id = credential_environment.environment_id",array())
            ->where("credential_environment.credential_id = $credentialId")
            ->order('name ASC');

        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
}
