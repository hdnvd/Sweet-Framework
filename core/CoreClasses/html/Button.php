<?php

namespace core\CoreClasses\html;

class Button extends baseHTMLElement {
	private $class,$name,$text,$id,$isSubmit,$type;
	function __construct($issubmit=true,$text="Button",$name=null,$id=null,$class=null)
	{
		$this->isSubmit=$issubmit;
		
		if(is_null($name))
			$name="btnnoname";
		if(is_null($id))
			$id=$name;
		if(is_null($class))
			$class=$id;
		
		
		$this->setName($name);
		$this->SetAttribute("value", $text);
		$this->setId($id);
		$this->setClass($class);
	}
	public function getHTML()
	{
		
		if(!$this->isSubmit)
			$this->setType("button");
		else
			$this->setType("submit");
		$html="<input ";
		$html.=$this->getAttributesDefinition() . " />";
		return $html;
	}

	protected function getType()
	{
	    return $this->getAttribute("type");
	}

	protected function setType($type)
	{
	   
		$this->SetAttribute("type", $type);
	}
}

?>