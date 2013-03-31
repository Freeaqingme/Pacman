<?php
namespace Pacman\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class EnvironmentTable extends AbstractTableGateway
{
	protected $table = 'environment';
	
	public function __construct(Adapter $adapter) {
		$this->adapter = $adapter;
		
		$this->resultSetPrototype = new ResultSet();
		$this->resultSetPrototype->setArrayObjectPrototype(new Environment());
		
		$this->initialize();
	}
	
	public function fetchAll()
	{
		$resultSet = $this->select();
		return $resultSet;
	}
	
      
	public function fetchById($environment_id)
    {
        $id  = (int) $id;

        $rowset = $this->select(array(
            'id' => $id,
        ));

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find environment with ID $id");
        }

        return $row;
    }
    
    /* @TODO
     * method fetchByProject
     * params $project_id <- id of the project
     * returns rowset of all environments of that project
    */
    
    public function fetchByProject($project_id)
    {
        /*$id  = (int) $id;

        $rowset = $this->select(array(
            'project_id' => $id,
        ));

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find project with ID $id");
        }
        */
        return null;
    }
    
}
