<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class UListElement extends baseHTMLElement {
	private $content;
	public function __construct($content,$id="LI",$class="LI")
	{
		$this->setClass($class);
		$this->setId($id);
		$this->content=$content;
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
		
		return "<li ". $this->getPropertyDefinition("id", $this->getId()) . $this->getPropertyDefinition("class", $this->getClass()) . $this->getPropertyDefinition("style", $this->getStyle()) . ">" . $this->content  . "</li>";
	}

	public function getContent()
	{
	    return $this->content;
	}

	public function setContent($content)
	{
	    $this->content = $content;
	}
}

?>