<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class BaseHTMLTag extends baseHTMLElement {
	private $Content,$Tag;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
		
		return "<" . $this->Tag . $this->getAttributesDefinition() . ">" . $this->Content . "</".$this->Tag.">";
	}

	protected function setContent($Content)
	{
	    $this->Content = $Content;
	}

	protected function setTag($Tag)
	{
	    $this->Tag = $Tag;
	}
}

?>