<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class Div extends baseHTMLElement {
	private $elements;
	public function addElement(baseHTMLElement $element)
	{
	    $this->elements[count($this->elements)] = $element;
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
		$html="<div". $this->getAttributesDefinition(). ">\n";
		for($i=0;$i<count($this->elements);$i++)
			$html.="\t\t" . $this->elements[$i]->getHTML() . "\n";
		$html.="</div>";
		return $html;
	}
}

?>