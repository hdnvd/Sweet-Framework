<?php

namespace core\CoreClasses\html;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\services\FieldType;

/**
 *
 * @author nahavandi
 *        
 */
class HTMLInput extends baseHTMLElement{
private $class,$name,$value,$id,$visible,$readonly,$type,$additonalAttr;
private $Type;
private $ValidationPattern;
private $MinLength;
    private $Required;
    /**
     * @param string $ValidationPattern
     */
    public function setValidationPattern($ValidationPattern)
    {
        $this->ValidationPattern = $ValidationPattern;
    }
    /**
     * @param FieldInfo $Inf
     */
    public function setFieldInfo(FieldInfo $Inf)
    {
        $this->setMaxLength($Inf->getMaxLength());
        $this->setMinLength($Inf->getMinLength());
        $this->setRequired($Inf->getRequired());
        $tp=$Inf->getType();
        switch($tp)
        {
            case FieldType::$TEXT:
                $this->setType("text");
                break;
            case FieldType::$EMAIL:
                $this->setType("email");
                $this->setValidationPattern('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$');
                break;
            case FieldType::$MELLICODE:
            case FieldType::$TEL:
            case FieldType::$INTEGER:
                $this->setType("text");
                $this->setValidationPattern('[0-9]');
                break;
            case FieldType::$MOBILE:
                $this->setType("text");
                $this->setValidationPattern('0[0-9]');
                break;
            case FieldType::$URL:
                $this->setType("url");
                break;
            default:
                $this->setType("text");

        }

    }
	function __construct($Name,$Value="",$ID=null,$Class="input",$ReadOnly=false) 
	{
		$this->setName($Name);
		$this->setValue($Value);
		if(!is_null($ID))
			$this->setId($ID);
		else
			$this->setId($Name);
		$this->setClass($Class);
		$this->setReadonly($ReadOnly);
		$this->setVisible(true);
	}
	public function setType($Type)
	{
		$this->Type=$Type;
		if($this->visible)
			$this->SetAttribute("type", $Type);
	}
	protected function setAdditonalAttr($additonalAttr)
	{
		$this->additonalAttr = $additonalAttr;
	}

	private function getAdditonalAttrHTML()
	{
		
		$html="";
		if(is_null($this->additonalAttr))
			$html.="";
		elseif(!is_array($this->additonalAttr))
			$html.=" " . $this->additonalAttr . " ";
		else 
		{
			for($i=0;$i<count($this->additonalAttr);$i++)
				$html.=" " . $this->additonalAttr[$i] . " ";
		}
		return $html;
	}
	public function getFullValidationPattern()
    {
        $minLen=$this->getMinLength();
        $maxLen=$this->getMaxLength();
        $Chars=$this->ValidationPattern;
        if($Chars=="")
            $Chars=".";
        return "pattern='" . $Chars . '{' . $minLen . ',' . $maxLen . "}" . "'";
    }
	public function getHTML() 
	{
		$html="<input ";
		if($this->readonly)
			$html.="readonly ";
		$html.=$this->getAttributesDefinition() . $this->getAdditonalAttrHTML() . " " . $this->getFullValidationPattern() ." />";
		return $html;
	}

	public function setVisible($visible)
	{
		$this->visible=$visible;
		if(!$visible)
			$this->SetAttribute("type", "hidden");
		else 
			$this->SetAttribute("type", $this->type);
	}

    protected function addAdditonalAttr($name,$value)
    {
        $thisVal=array("$name=\"$value\"");
        if($this->additonalAttr==null) {
            $this->additonalAttr=$thisVal;
        }
        else if (is_array($this->additonalAttr)) {
            array_push($this->additonalAttr, $thisVal);
        }
        else//Is String
        {
            $allVal=array("$name=\"$value\"",$this->additonalAttr);
            $this->additonalAttr=$allVal;
        }
    }
	public function setValue($value)
	{
	    $this->SetAttribute("value", $value);
	}
	public function getValue()
	{
		return $this->getAttribute("value");
	}
	public function setReadonly($readonly)
	{
		$this->readonly=$readonly;
	}

	public function getMaxLength()
	{
	    return $this->getAttribute("maxlength");
	}

	public function setMaxLength($MaxLength)
	{
	    $this->SetAttribute("maxlength", $MaxLength);
	}
    public function getMinLength()
    {
        return $this->MinLength;
    }

    public function setMinLength($MinLength)
    {
        $this->MinLength=$MinLength;
    }
    /**
     * @param mixed $Required
     */
    public function setRequired($Required)
    {
        $this->Required = $Required;
        if($this->Required)
            $this->SetAttribute("required","required");
    }
}

?>