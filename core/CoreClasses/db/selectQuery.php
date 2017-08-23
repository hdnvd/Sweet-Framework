<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:1393/11/27
*/
namespace core\CoreClasses\db;

class selectQuery extends baseLogicalQuery{
	
	private $tables,$selectFields,$limit;
	/**
	 * @var array
	 */
	private $orderByFields,$IsOrderedDescendings,$GroupBys;
	public function __construct($selectFields,dbaccess $dbObject)
	{
		$this->selectFields=$selectFields;
		$this->dbObject=$dbObject;
		$this->debugmode=false;
		$this->orderByFields=array();
		$this->IsOrderedDescendings=array();
		$this->GroupBys=array();
	}
	private function getDataArray(\PDOStatement $statement,$fetchMode=\PDO::FETCH_OBJ)
	{
		$object=null;
		for($i=0;$obj=$statement->fetch($fetchMode);$i++)
		{
			$object[$i]=$obj;
		}
		if($this->dbObject->getAutoClose())
		  $this->dbObject->close_connection();
		return $object;
	}
	
	/**
	 * @param array $tables
	 * @return selectQuery
	 */
	public function From($tables)
	{
		$this->tables=$tables;
		return $this;
	}
	public function getQueryString()
	{
		
		global $setting_tablePrefix;
		if(!is_null($this->tables) && !is_null($this->selectFields))
		{
			
			//Select
			$this->query="SELECT ";
			$fields=$this->selectFields;
			if(is_array($fields))
			{
				for ($i=0;$i<count($fields);$i++)
				{
					if($i!=0)
						$this->query.=" , ";
					$this->query.=$this->getFieldString($setting_tablePrefix, $fields[$i]);
				}
			}
			else
				$this->query.=$this->getFieldString($setting_tablePrefix, $fields);
			
			//End Of Select
			
			//FROM
			$this->query.=" FROM ";
			$tables=$this->tables;
			if(is_array($tables))
			{
				for ($i=0;$i<count($tables);$i++)
				{
					$tables[$i]=$setting_tablePrefix . $tables[$i];
					if($i==0)
						$this->query.=$tables[$i];
					else
						$this->query.= ","  . $tables[$i];
				}
			}
			else
				$this->query.=$setting_tablePrefix . $tables;
			//End OF FROM
			
			//WHERE
			if($this->WhereCount>0)
			{
				$this->query.=" WHERE ";
				if(count($this->Statements)>0)
					for($i=0;$i<count($this->Statements);$i++)
						$this->query.=$this->Statements[$i] . " ";
			}
			
			//End Of WHERE
			
			//Group BY
				
			for($GroupFieldIndex=0;$GroupFieldIndex<count($this->GroupBys);$GroupFieldIndex++)
			{
			if($GroupFieldIndex==0)
				$this->query.=" GROUP BY " ;
			else
				$this->query.=" , " ;
			$this->query.= " " . $this->GroupBys[$GroupFieldIndex];
			
			}
			//End OF Group BY


			//ORDER BY
				
			for($OrderFieldIndex=0;$OrderFieldIndex<count($this->orderByFields);$OrderFieldIndex++)
			{
			if($OrderFieldIndex==0)
			    $this->query.=" ORDER BY " ;
				else
			$this->query.=" , " ;
			$orderType="ASC";
			if($this->IsOrderedDescendings[$OrderFieldIndex])
			    $orderType="DESC";
			    $this->query.= " " . $this->orderByFields[$OrderFieldIndex] . " " . $orderType;
			
			}
			//End OF ORDER BY
			
			//LIMIT
			if($this->limit!=null)
			{
				$this->query.=" LIMIT " . $this->limit;
			}
			//End OF LIMIT
			
		}
		else 
			$query="--Query Is Not Complete!";
		return $this->query;
	}
	
	/**
	 * @param String $Field
	 * @param Boolean $IsDescending
	 * @return selectQuery;
	 */
	public function AddOrderBy($Field,$IsDescending)
	{
        global $setting_tablePrefix;
		array_push($this->orderByFields,$this->getValueString($setting_tablePrefix,$Field));
		array_push($this->IsOrderedDescendings,$IsDescending);
		return $this;
	}
	/**
	 * @param String $Field
	 * @return selectQuery;
	 */
	public function AddGroupBy($Field)
	{
        global $setting_tablePrefix;
        array_push($this->GroupBys,$this->getValueString($setting_tablePrefix,$Field));
		return $this;
	}
	public function Execute()
	{
	    $this->dbObject->connectToDatabase();
		$ObjectArray=$this->getDataArray($this->dbObject->ExecuteQuery($this->getQueryString()));
		return $ObjectArray;
	}
	public function ExecuteAssociated()
	{
	    $this->dbObject->connectToDatabase();
		return $this->getDataArray($this->dbObject->ExecuteQuery($this->getQueryString()),\PDO::FETCH_ASSOC);
	}
    public function GetFileds()
    {
        $this->dbObject->connectToDatabase();
        $e=$this->dbObject->ExecuteQuery($this->getQueryString());
        for ($i = 0; $i < $e->columnCount(); $i++) {
            $col = $e->getColumnMeta($i);
            $columns[] = $col['name'];
        }
        return $columns;

    }

	public function setLimit($Limit)
	{
	    $this->limit = $Limit;
	    return $this;
	}
}

?>