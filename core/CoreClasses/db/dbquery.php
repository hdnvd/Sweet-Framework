<?php
/*
 *@Author:Hadi AmirNahavandi
 *@Last Update:2015/2/14
*/
namespace core\CoreClasses\db;

class dbquery
{
	private  $debugmode,$dbObject;
	function __construct(dbaccess $dbAccessor=null)
	{
		$this->debugmode=false;
		$this->dbObject=null;
		if($dbAccessor!==null)
		    $this->dbObject=$dbAccessor;
	}
	public function getDBAccessor()
	{
		return $this->dbObject;
	}
	public function makeNewDBObject()
	{
	    if($this->dbObject===null)
		  $this->dbObject=new dbaccess();
	    elseif ($this->dbObject->isClosed())
	       $this->dbObject->connectToDatabase();
	}
	function turnOnDebugMode()
	{
		$this->debugmode=true;
		
	}
	
	public function Select($fields)
	{
		$this->makeNewDBObject();
		return new selectQuery($fields,$this->dbObject);
	}
	public function InsertInto($table)
	{
		$this->makeNewDBObject();
		return new insertQuery($table,$this->dbObject);
	}
	/**
	 * @param String $table
	 * @return updateQuery
	 */
	public function Update($table)
	{
		$this->makeNewDBObject();
		return new updateQuery($table,$this->dbObject);
	}
	public function Delete($table)
	{
		$this->makeNewDBObject();
		return new deleteQuery($table,$this->dbObject);
	}
	
}
?>
