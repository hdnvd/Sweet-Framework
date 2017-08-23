<?php

namespace core\CoreClasses\db;

/**
 *
 * @author nahavandi
 *        
 */
class QueryLogic {
	private $Limit;
	private $IsDescendings;
	private $OrderByFields;
	private $Conditions;
    private $ResultFields;


    /**
     * @return boolean[]
     */
    public function getIsDescendings()
    {
        return $this->IsDescendings;
    }

    /**
     * @return string[]
     */
    public function getOrderByFields()
    {
        return $this->OrderByFields;
    }

    /**
     * @return array
     */
    public function getResultFields()
    {
        return $this->ResultFields;
    }

    /**
     * @param array $ResultFields
     */
    public function setResultField($ResultFields)
    {
        $this->ResultFields = $ResultFields;
    }
    /**
     * @param string $Field
     */
    public function addResultField($FieldName)
    {
        array_push($this->ResultFields,$FieldName);
    }
    /**
     * @return FieldCondition[]
     */
    public function getConditions()
    {
        return $this->Conditions;
    }

    /**
     * @param FieldCondition[] $Conditions
     */
    public function setConditions($Conditions)
    {
        $this->Conditions = $Conditions;
    }

    /**
     * @return string
     */
    public function getLimit()
    {
        return $this->Limit;
    }

    /**
     * @param string $Limit
     */
    public function setLimit($Limit)
    {
        $this->Limit = $Limit;
    }

    public function __construct()
    {
        $this->IsDescendings=array();
        $this->OrderByFields=array();
        $this->Conditions=array();
        $this->ResultFields=array();
    }

    /**
     * @param string $FiledName
     * @param boolean $IsDescending
     */
    public function addOrderBy($FiledName, $IsDescending)
    {
        array_push($this->OrderByFields,$FiledName);
        array_push($this->IsDescendings,$IsDescending);
    }

    /**
     * @param FieldCondition $condition
     */
    public function addCondition(FieldCondition $condition)
    {
        array_push($this->Conditions,$condition);
    }

}

?>