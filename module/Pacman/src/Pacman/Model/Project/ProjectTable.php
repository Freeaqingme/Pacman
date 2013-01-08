<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @author Rob Quist ()
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Project;

use Pacman\Model\Project\Project;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class ProjectTable extends AbstractTableGateway
{
    /**
     * db table name
     * @var string
     */
    protected $table = 'project';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Project());

        $this->initialize();
    }

    /**
     * Fetch all
     *
     * @return ResultSet
     */
    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    /**
     * Fetch latest 5
     *
     * @return ResultSet
     */
    public function fetchLatest()
    {
        $resultSet = $this->select(function (Select $select) {
            $select->order('id DESC')->limit(5);
        });

        return $resultSet;
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

        $rowset = $this->select(array(
            'id' => $id,
        ));

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find project with ID $id");
        }

        return $row;
    }
}
