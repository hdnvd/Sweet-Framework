<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/08
*/
namespace core\CoreClasses\db;

use core\CoreClasses\Exception\NotImplementedException;

class baseLogicalQuery extends baseQuery
{
	protected  $WhereCount,$Statements;
	/**
	 * @return baseLogicalQuery
	 */
	public function Where()
	{
		$this->query .=" WHERE ";
		$this->WhereCount++;
		return $this;
	}
	/**
	 * @return baseLogicalQuery
	 */
	public function OpenParenthesis()
	{
		$newIndex=count($this->Statements);
		$this->Statements[$newIndex]=" ( ";
		$this->query.= " ( ";
		return $this;
	}
	/**
	 * @return baseLogicalQuery
	 */
	public function CloseParenthesis()
	{
		$newIndex=count($this->Statements);
		$this->Statements[$newIndex]=" ) ";
		$this->query.= " ) ";
		return $this;
	}
	/**
	 * @return baseLogicalQuery
	 */
	public function OrLogic()
	{
		$newIndex=count($this->Statements);
		$this->Statements[$newIndex]=" OR ";
		$this->query.= " OR ";
		return $this;
	}
	/**
	 * @return baseLogicalQuery
	 */
	public function AndLogic()
	{
		$newIndex=count($this->Statements);
		$this->Statements[$newIndex]=" AND ";
		$this->query.= " AND ";
		return $this;
	}


    /**
     * @param FieldCondition $Condition
     * @return baseLogicalQuery
     * @throws NotImplementedException
     */
    public function AddFieldCondition(FieldCondition $Condition)
    {

        if($Condition->getLogic()==LogicalOperator::Equal)
            return $this->Equal($Condition->getFiledName(),$Condition->getFiledValue());
        elseif($Condition->getLogic()==LogicalOperator::LIKE)
            return $this->Like($Condition->getFiledName(),$Condition->getFiledValue());
        elseif($Condition->getLogic()==LogicalOperator::Bigger)
            return $this->Bigger($Condition->getFiledName(),$Condition->getFiledValue());
        elseif($Condition->getLogic()==LogicalOperator::Smaller)
            return $this->Smaller($Condition->getFiledName(),$Condition->getFiledValue());
        else
            throw new NotImplementedException();
    }
	/**
	 * @return baseLogicalQuery
	 */
	public function Equal($field,$value)
	{
		global $setting_tablePrefix;
		$field=$this->getFieldString($setting_tablePrefix, $field);
		$value=$this->getValueString($setting_tablePrefix, $value);
		$newIndex=count($this->Statements);
		$this->Statements[$newIndex]=$field . "=" . $value . " ";
		$this->query.= "" . $field . "=" . $value . " ";
		return $this;
	}
	/**
	 * @return baseLogicalQuery
	 */
	public function Bigger($field,$value)
	{
		global $setting_tablePrefix;
		$field=$this->getFieldString($setting_tablePrefix, $field);
		$value=$this->getValueString($setting_tablePrefix, $value);
		$newIndex=count($this->Statements);
		$this->Statements[$newIndex]=$field . ">" . $value . " ";
		$this->query.= "" . $field . ">" . $value . " ";
		return $this;
	}
	/**
	 * @return baseLogicalQuery
	 */
	public function Smaller($field,$value)
	{
		global $setting_tablePrefix;
		$field=$this->getFieldString($setting_tablePrefix, $field);
		$value=$this->getValueString($setting_tablePrefix, $value);
		$newIndex=count($this->Statements);
		$this->Statements[$newIndex]=$field . "<" . $value . " ";
		$this->query.= "" . $field . "<" . $value . " ";
		return $this;
	}
	/**
	 * @return baseLogicalQuery
	 */
	public function Like($field,$value)
	{
		global $setting_tablePrefix;
		$field=$this->getFieldString($setting_tablePrefix, $field);
		$value=$this->getValueString($setting_tablePrefix, $value);
		$newIndex=count($this->Statements);
		$this->Statements[$newIndex]=$field . " LIKE " . $value . " ";
		$this->query.="" . $field . " LIKE " . $value . " ";
		return $this;
	}
	protected function getFieldString($tablePrefix,$field)
	{
		if(is_object($field))
		{
			if(get_class($field)=="core\CoreClasses\db\DBValue")
            {

                $tmpField=$field->getField();
                $Str=$this->dbObject->quote($tmpField);
            }
            else
            {

                $tmpField=$field->getField();
                if($field->getAddTablePrefix())
                    $tmpField=$tablePrefix . $tmpField;
                $Str=$tmpField;
            }
		}
		else
			$Str= $field;
		return $Str;
	}
	protected function getValueString($tablePrefix,$field,$AddQuotationMark=true)
	{
		if(is_object($field))
		{
	
			$tmpField=$field->getField();
			if($field->getAddTablePrefix())
				$tmpField=$tablePrefix . $tmpField;
			$Str=$tmpField;
		}
		else
        {
            if($AddQuotationMark)
                $Str= $this->dbObject->quote($field);
            else
            {
                $Str=$this->dbObject->quote( $field );
                $Str=substr($Str,1,-1);
            }

        }


		return $Str;
	}
}

?>