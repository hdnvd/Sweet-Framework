<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/08
*/
namespace core\CoreClasses\db;

class insertQuery extends baseQuery{
	private $table,$sets;
	public function __construct($table,dbaccess $dbObject)
	{
		parent::__construct("", $dbObject);
		$this->table=$table;
		$this->debugmode=false;
	}
	public function Set($field,$value)
	{
		$newIndex=count($this->sets);
		$this->sets[$newIndex]["field"]=$field;
		$this->sets[$newIndex]["value"]=$value;
		return $this;
	}
	public function getQueryString()
	{
		global $setting_tablePrefix;
		$table=$setting_tablePrefix . $this->table;
		if(count($this->sets)>0 && !is_null($table))
		{
			//InsertInto
			$this->query="INSERT INTO " . $table;
			
			//Fields
			$this->query.="(";
			for($i=0;$i<count($this->sets);$i++)
			{
				$setStatement=$this->sets[$i];
				if($i>0)
					$this->query.=", ";
				$this->query.=$setStatement["field"] . " ";
			}
			$this->query.=")";
			//End Of Fields
			
			//Values
			$this->query.=" VALUES(";
			for($i=0;$i<count($this->sets);$i++)
			{
				$setStatement=$this->sets[$i];
				if($i>0)
					$this->query.=", ";
				$this->query.=$this->dbObject->quote($setStatement["value"]) . " ";
			}
			$this->query.=")";
			//End Of Values
			
		}
		else
			$query="--Query Is Not Complete!";
		return $this->query;
	}
	public function getInsertedId()
	{
		if($this->isExecuted)
			return $this->dbObject->getInsertedId();
		else
			return -1;
	}
	
	
}

?>