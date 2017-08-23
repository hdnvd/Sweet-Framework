<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 07/06/2017
 * Time: 01:24 AM
 */

namespace core\CoreClasses\db;


class FieldCondition
{
    private $FiledName;
    private $FiledValue;
    private $Logic;

    /**
     * @return string
     */
    public function getFiledName()
    {
        return $this->FiledName;
    }

    /**
     * @param string $FiledName
     */
    public function setFiledName($FiledName)
    {
        $this->FiledName = $FiledName;
    }

    /**
     * @return mixed
     */
    public function getFiledValue()
    {
        return $this->FiledValue;
    }

    /**
     * @param mixed $FiledValue
     */
    public function setFiledValue($FiledValue)
    {
        $this->FiledValue = $FiledValue;
    }

    /**
     * @return int
     */
    public function getLogic()
    {
        return $this->Logic;
    }

    /**
     * @param int $Logic
     */
    public function setLogic($Logic)
    {
        $this->Logic = $Logic;
    }

    /**
     * FieldCondition constructor.
     * @param string $FiledName
     * @param mixed $FiledValue
     * @param int $Logic
     */
    public function __construct($FiledName, $FiledValue, $Logic=LogicalOperator::Equal)
    {
        $this->FiledName=$FiledName;
        $this->FiledValue=$FiledValue;
        $this->Logic=$Logic;
    }

}