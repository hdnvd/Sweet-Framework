<?php

namespace core\CoreClasses\html;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class UList extends baseHTMLElement {
	private $elements;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
		
		$html="<ul ".$this->getAttributesDefinition()." >\n";
		
		for($i=0;$i<count($this->elements);$i++)
		{
			$html.="\t\t" . $this->elements[$i]->getHTML() . "\n";
			
		}
		$html.="</ul>";
		return $html;
	}

	public function addElement(UListElement $element)
	{
	    $this->elements[count($this->elements)] = $element;
	}
}

?>