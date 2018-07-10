<?php

namespace core\CoreClasses\html;

class elementGroup extends baseHTMLElement {
	private $elements;
	public function addElement(baseHTMLElement $element)
	{
		$this->elements[count($this->elements)]=$element;
	}
	public function getHTML() 
	{
		$html="";
		foreach ($this->elements as $element)
			$html.="\n\t" . $element->getHTML();
		return $html;
	}
	public function getElements()
	{
		return $this->elements;
	}
}

?>