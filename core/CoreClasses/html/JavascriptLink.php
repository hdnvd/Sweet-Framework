<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class JavascriptLink extends baseHTMLElement {
	
	private $Link;
	public function __construct($Link)
	{
		$this->setLink($Link);
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
		return "<script src=\"".$this->Link."\" type=\"text/javascript\" language=\"javascript\"></script>";
	}

	public function getLink()
	{
	    return $this->Link;
	}

	public function setLink($Link)
	{
	    $this->Link = $Link;
	}
}

?>