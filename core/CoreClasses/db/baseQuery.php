<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/08
*/
namespace core\CoreClasses\db;

abstract class baseQuery {
	protected $debugmode,$dbObject,$query,$isExecuted;
	function __construct($query,dbaccess $dbObject)
	{
		$this->query=$query;
		$this->dbObject=$dbObject;
		$this->debugmode=false;
		$this->isExecuted=false;
	}
	function turnOnDebugMode()
	{
		$this->debugmode=true;
	}
	public function getQueryString()
	{
		return  $this->query;
	}
	public function getIsExecuted()
	{
		return $this->IsExecuted;
	}
	public function Execute()
	{
		$this->isExecuted=true;
		return $this->dbObject->ExecuteNonQuery($this->getQueryString());
	}
	public function __toString()
	{
		return $this->getQueryString();
	}
}

?>