<?php

namespace core\CoreClasses\html;

class TextArea extends baseHTMLElement {
	private $content;
	function __construct($name="TextArea",$content="",$id=null,$class=null) 
	{
		
		if(is_null($id))
			$id=$name;
		if (is_null($class))
			$class=$id;
		$this->content=$content;
		$this->setName($name);
		$this->setId($id);
		$this->setClass($class);
	}
	public function getHTML() 
	{
		$html="<textarea ".$this->getAttributesDefinition().">" . $this->content . "</textarea>";
		return $html;
	}
	public function getValue()
	{
		if(isset($_POST[$this->getName()]))
			return $_POST[$this->getName()];
		else 
			return $this->content;
	}
	public function setValue($content)
	{
		$this->content=$content;
	}
}

?>