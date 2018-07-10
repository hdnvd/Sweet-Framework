<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class CheckedTextBox extends TextBox {
	private $Lable;
	public function setLable($Lable)
	{
		$this->Lable=$Lable;
	}
	public function getValue()
	{
		if(isset($_POST["__ident" . $this->getName()]) && $_POST["__ident" . $this->getName()]=="1")
			return $this->getAttribute("value");
		else 
			return null;
	}
	public function getHTML()
	{
		$chk1=new CheckBox("__ident" . $this->getName());
		$chk1->addOption($this->Lable,"1");
		return $chk1->getHTML() .  parent::getHTML();
	}
		
}

?>