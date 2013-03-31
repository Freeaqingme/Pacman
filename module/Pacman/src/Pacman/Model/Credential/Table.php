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
     * Save credential (new / edit)
     *
     * @todo - This is a stub! As you can see.
     *
     * @param array $properties
     * @return Entity
     */
    public function saveCredential($properties)
    {    
        //@todo link all the correct ID's
        $valueArray = array();
        $valueArray['project_id'] = 1;
        $valueArray['category_id'] = 1;
        $valueArray['cluster_id'] = 1;
        $valueArray['server_id'] = 1;
        $valueArray['username'] = $properties->username;
        $valueArray['password'] = $properties->password;
        $valueArray['url'] = $properties->url;
        $valueArray['notes'] = $properties->notes;

        if ($properties->id == null) {
            //Insert
            return $this->tableGateway->insert($valueArray);
            
        } else {
            //Update
            return $this->tableGateway->update($valueArray, 
                        array('id' => $properties->id)
                    );
        }

    }
    
    public function deleteCredential($properties)
    {
        if (is_int($properties)) {
            //Maybe the code gave us just an ID instead of the whole properties array
            return $this->tableGateway->delete(array('id' => $properties));
        } else {
            //It wasn't an int. Lets assume it was a property array
            if ($properties->id != null) {
                return $this->tableGateway->delete(array('id' => $properties->id));
            } else {
                return false;
            }
            
        }
    
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
