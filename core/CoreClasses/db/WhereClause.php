<?php

namespace core\CoreClasses\db;

/**
 *
 * @author nahavandi
 *        
 */
class WhereClause {
	private $Fields,$FieldValues,$LogicalOperators;
	public function addLogic($Field,int $Operator,$Value)
	{
		array_push($this->Fields, $Field);
		array_push($this->LogicalOperators, $Operator);
		array_push($this->FieldValues, $Value);
	}
	public function popLogic()
	{
		$return=array();
		$return['field']=array_pop($this->Fields);
		$return['operator']=array_pop($this->Operator);
		$return['value']=array_pop($this->FieldValues);
		return $return;
	}
}

?>