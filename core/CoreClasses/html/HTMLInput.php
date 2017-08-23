<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class HTMLInput extends baseHTMLElement{
private $class,$name,$value,$id,$visible,$readonly,$type,$additonalAttr;
private $MaxLength,$Type;
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
	protected function setType($Type)
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
	public function getHTML() 
	{
		$html="<input ";
		if($this->readonly)
			$html.="readonly ";
		$html.=$this->getAttributesDefinition() . $this->getAdditonalAttrHTML() . " />";
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
	    $this->getAttribute("maxlength");
	}

	public function setMaxLength($MaxLength)
	{
	    $this->SetAttribute("maxlength", $MaxLength);
	}
}

?>