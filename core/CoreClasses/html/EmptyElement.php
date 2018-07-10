<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class EmptyElement extends baseHTMLElement {
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
		
		return "";
	}
}

?>