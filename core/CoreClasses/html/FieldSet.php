<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class FieldSet extends baseHTMLElement {
	private $Legend;
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
		
		$html="<Fieldset " . $this->getPropertyDefinition("id", $this->getId()) . $this->getPropertyDefinition("class", $this->getClass()) . $this->getPropertyDefinition("style", $this->getStyle()) . ">";
		$html.="<Legend>" . $this->Legend . "</Legend>";
		for($i=0;$i<count($this->elements);$i++)
		{
			$html.="\t\t" . $this->elements[$i]->getHTML() . "\n";
		
		}
		$html.="</Fieldset>";
		return $html;
	}

	public function getLegend()
	{
	    return $this->Legend;
	}

	public function setLegend($Legend)
	{
	    $this->Legend = $Legend;
	}
}

?>