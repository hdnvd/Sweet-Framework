<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/21
*/
namespace core\CoreClasses\db;

class updateQuery extends baseLogicalQuery
{
	private $table,$sets;
	public function __construct($table, $dbObject)
	{
		$this->table=$table;
		$this->dbObject=$dbObject;
	}
	public function Set($field,$value)
	{
		$newIndex=count($this->sets);
		$this->sets[$newIndex]["field"]=$field;
		$this->sets[$newIndex]["value"]=$value;
		return $this;
	}
	/**
	 * Sets The Field If Field Is Not Null
	 * 
	 * @param String $field :Field Name
	 * @param String $value :Field Value
	 */
	public function NotNullSet($field,$value)
	{
		if(!is_null($field) && !is_null($value))
			return $this->Set($field, $value);
		else 
			return $this;
	}
	public function getQueryString()
	{
		global $setting_tablePrefix;
		$table=$setting_tablePrefix . $this->table;
		if(count($this->sets)>0 && count($this->Statements>0))
		{
			$this->query="UPDATE " . $table;
			$this->query.=" SET ";
			for($i=0;$i<count($this->sets);$i++)
			{
				$setStatement=$this->sets[$i];
				if($i>0)
					$this->query.=", ";
				$this->query.=$setStatement["field"] . " = " . $this->dbObject->quote($setStatement["value"]) . " ";
			}
			if($this->WhereCount>0)
			{
				$this->query.=" WHERE ";
				if(count($this->Statements)>0)
					for($i=0;$i<count($this->Statements);$i++)
						$this->query.=$this->Statements[$i] . " ";
			}
		}
		else 
			$query="--Query Is Not Complete!";
		return $this->query;
	}
}

?>