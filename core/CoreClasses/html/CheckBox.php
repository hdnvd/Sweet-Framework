<?php

namespace core\CoreClasses\html;

use core\CoreClasses\sweetArray;
/**
 *
 * @author nahavandi
 *        
 */
class CheckBox extends HTMLInput {
	private $OptionTexts;
	private $OptionValues;
	private $SelectedValues;
	function __construct($name) 
	{
		$this->setName($name);
		$this->setId($name);
		$this->OptionTexts=array();
		$this->OptionValues=array();
		$this->SelectedValues=array();
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
	    $CheckBox=new Div();
	    $CheckBox->setClass($this->getClass());
	    $CheckBox->setId($this->getId() . "box");
		
		$IdentOption=new CheckBoxOption($this->getName());
		$IdentOption->setChecked(true);
		$IdentOption->setText("");
		$IdentOption->setValue("__ident");
		$IdentOption->setVisible(false);
		$IdentOption->setId($this->getId());
		$CheckBox->addElement($IdentOption);
		
		
		for($i=0;$i<count($this->OptionTexts);$i++)
		{
			$Option[$i]=new CheckBoxOption($this->getName());
			$Option[$i]->setId($this->getId());
			$Option[$i]->setText($this->OptionTexts[$i]);
			$Option[$i]->setValue($this->OptionValues[$i]);
			
			if($this->SelectedValues!==null && sweetArray::FindInArray($this->OptionValues[$i], $this->SelectedValues)>=0)
			    $Option[$i]->setChecked(true);
			
			$OptionDiv[$i]=new Div();
			$OptionDiv[$i]->setClass("checkboxoption");
			$OptionDiv[$i]->addElement($Option[$i]);
			
			$CheckBox->addElement($OptionDiv[$i]);
		}
		return $CheckBox->getHTML();
	}
	public function addOption($Text,$Value)
	{
		array_push($this->OptionTexts,$Text);
		array_push($this->OptionValues,$Value);
	}


	public function addSelectedValue($SelectedValue)
	{
	    array_push($this->SelectedValues,$SelectedValue);
	}

	private function isMultiselectable()
    {

        $paramName=$this->getName();
        if(substr($paramName,strlen($paramName)-2,2)=="[]")
            return true;
        return false;
    }
	public function getSelectedValues()
	{
	    $paramName=$this->getName();
	    if($this->isMultiselectable())
	        $paramName=substr($paramName,0,strlen($paramName)-2);
        $selval=$this->SelectedValues;
		if(isset($_POST[$paramName])){
		    $selval=$_POST[$paramName];
        }

        if(!$this->isMultiselectable())
        {
            if(count($selval)<=1)//__ident
                return false;
            return $selval;
        }
        $this->SelectedValues=array();
        for ($i=0;$selval!=null && is_array($selval) && $i<count($selval);$i++)
        {
            if($selval[$i]!="__ident")
                array_push($this->SelectedValues,$selval[$i]);
        }
		return $this->SelectedValues;
	}
}

?>