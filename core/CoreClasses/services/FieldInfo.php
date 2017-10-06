<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/29/2017
 * Time: 1:52 AM
 */

namespace core\CoreClasses\services;


use core\CoreClasses\Exception\FieldRequiredException;
use core\CoreClasses\Exception\FieldTooLargeException;
use core\CoreClasses\Exception\FieldTooSmallException;
use core\CoreClasses\Exception\InvalidFieldException;

class FieldInfo
{
    private $Title;
    private $Required=false;
    private $MaxLength;
    private $MinLength;
    private $Type;
    private $Regex;
    private $Index;

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->Index;
    }

    /**
     * @param mixed $Index
     */
    public function setIndex($Index)
    {
        $this->Index = $Index;
    }

    /**
     * @return mixed
     */
    public function getRegex()
    {
        return $this->Regex;
    }

    /**
     * @param mixed $Regex
     */
    public function setRegex($Regex)
    {
        $this->Regex = $Regex;
    }

    /**
     * FieldInfo constructor.
     */
    public function __construct()
    {
        $this->Required=false;
        $this->MinLength=0;
        $this->MaxLength=10000000;
        $this->setRegex("");
        $this->setType(FieldType::$TEXT);
    }
    public function getCopy()
    {
        $fInf2=new FieldInfo();
        $fInf2->setTitle($this->getTitle());
        $fInf2->setMinLength($this->getMinLength());
        $fInf2->setMaxLength($this->getMaxLength());
        $fInf2->setRequired($this->getRequired());
        $fInf2->setType($this->getType());
        $fInf2->setRegex($this->getRegex());
        $fInf2->setIndex($this->getIndex());
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
    public function Validate($FieldValue)
    {
        if($this->getRequired() && $FieldValue=="")
           throw new FieldRequiredException();
        if(strlen($FieldValue)>$this->getMaxLength())
           throw new FieldTooLargeException();
        if(strlen($FieldValue)>0 && strlen($FieldValue)<$this->getMinLength())
           throw new FieldTooSmallException();

        if($this->getType()==FieldType::$MELLICODE)
            $this->validateMelliCode($FieldValue);
        return true;
    }
    private function validateMelliCode($Code)
    {
        $sum=0;
        $ControllDigit=substr($Code,9,1);
        for($digitIndex=10;$digitIndex>1;$digitIndex--)
        {
            $digit=substr($Code,10-$digitIndex,1);
            $sum+=$digit*$digitIndex;
        }
//        echo $sum;
//        echo "CD:" . $ControllDigit;
        $Remaining=$sum%11;
        if($Remaining<2)
        {
            if($Remaining!=$ControllDigit)
                throw new InvalidFieldException("شماره ملی صحیح نمی باشد");
        }
        elseif((11-$Remaining)!=$ControllDigit)
            throw new InvalidFieldException("شماره ملی صحیح نمی باشد");
        return true;
    }
    /**
     * @param mixed $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
        switch($Type)
        {
            case FieldType::$EMAIL:
                $this->setRegex('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$');
                break;
            case FieldType::$MELLICODE:
                $this->setRegex('[0-9]');
                $this->setMinLength(10);
                $this->setMaxLength(10);
                break;
            case FieldType::$TEL:
            case FieldType::$INTEGER:
                $this->setRegex('[0-9]');
                break;
            case FieldType::$MOBILE:
                $this->setMinLength(11);
                $this->setMaxLength(11);
                $this->setRegex('09[0-9]');
                break;

        }

    }
}