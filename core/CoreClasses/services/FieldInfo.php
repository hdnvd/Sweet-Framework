<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/29/2017
 * Time: 1:52 AM
 */

namespace core\CoreClasses\services;


class FieldInfo
{
    private $Title;
    private $Required=false;
    private $MaxLength;
    private $MinLength;
    private $Type;

    /**
     * FieldInfo constructor.
     */
    public function __construct()
    {
        $this->Required=false;
        $this->MinLength=0;
        $this->MaxLength=10000000;
        $this->Type=FieldType::$TEXT;
    }
    public function getCopy()
    {
        $fInf2=new FieldInfo();
        $fInf2->setTitle($this->getTitle());
        $fInf2->setMinLength($this->getMinLength());
        $fInf2->setMaxLength($this->getMaxLength());
        $fInf2->setRequired($this->getRequired());
        $fInf2->setType($this->getType());
        return $fInf2;
    }
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param mixed $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    /**
     * @return mixed
     */
    public function getRequired()
    {
        return $this->Required;
    }

    /**
     * @param mixed $Required
     */
    public function setRequired($Required)
    {
        $this->Required = $Required;
    }

    /**
     * @return mixed
     */
    public function getMaxLength()
    {
        return $this->MaxLength;
    }

    /**
     * @param mixed $MaxLength
     */
    public function setMaxLength($MaxLength)
    {
        $this->MaxLength = $MaxLength;
    }

    /**
     * @return mixed
     */
    public function getMinLength()
    {
        return $this->MinLength;
    }

    /**
     * @param mixed $MinLength
     */
    public function setMinLength($MinLength)
    {
        $this->MinLength = $MinLength;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param mixed $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
    }
}