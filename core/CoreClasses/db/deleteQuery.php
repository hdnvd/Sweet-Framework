<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/21
*/
namespace core\CoreClasses\db;

class deleteQuery extends baseLogicalQuery
{
	private $table;
	public function __construct($table, $dbObject)
	{
		$this->table=$table;
		$this->dbObject=$dbObject;
	}
	
	public function getQueryString()
	{
		global $setting_tablePrefix;
		$table=$setting_tablePrefix . $this->table;
			$this->query="DELETE FROM " . $table;
			if($this->WhereCount>0)
			{
				$this->query.=" WHERE ";
				if(count($this->Statements)>0)
					for($i=0;$i<count($this->Statements);$i++)
						$this->query.=$this->Statements[$i] . " ";
			}
		return $this->query;
	}
}

?>