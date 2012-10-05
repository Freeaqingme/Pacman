<?php
namespace Pacman\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class ProjectTable extends AbstractTableGateway
{
	protected $table = 'project';
	
	public function __construct(Adapter $adapter) {
		$this->adapter = $adapter;
		
		$this->resultSetPrototype = new ResultSet();
		$this->resultSetPrototype->setArrayObjectPrototype(new Project());
		
		$this->initialize();
	}
	
	public function fetchAll()
	{
		$resultSet = $this->select();
		return $resultSet;
	}
	
	public function fetchLatest()
	{
	
		$resultSet = $this->select(function (Select $select) {
			$select->order('name ASC')->limit(5);
		});
		
		return $resultSet;
	}
	

}
