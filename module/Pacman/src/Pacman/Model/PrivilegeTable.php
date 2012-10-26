<?php
namespace Pacman\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class PrivilegeTable extends AbstractTableGateway
{
	protected $table = 'privileges';
	
	public function __construct(Adapter $adapter) {
		$this->adapter = $adapter;
		
		$this->resultSetPrototype = new ResultSet();
		$this->resultSetPrototype->setArrayObjectPrototype(new Privilege());
		
		$this->initialize();
	}
	
	public function fetchAll()
	{
		$resultSet = $this->select();
		return $resultSet;
	}
	
	public function fetchByProject($id)
    {
        $id  = (int) $id;

        $rowset = $this->select(array(
            'project_id' => $id,
        ));

        $row = $rowset->current();

        if (!$row) {
            return array(); // Empty rowset instead of array?
        }

        return $row;
    }
    
	public function fetchByUser($id)
    {
        $id  = (int) $id;

        $rowset = $this->select(array(
            'user_id' => $id,
        ));

        $row = $rowset->current();

        if (!$row) {
            return array(); // Empty rowset instead of array?
        }

        return $row;
    }
    
    

}
