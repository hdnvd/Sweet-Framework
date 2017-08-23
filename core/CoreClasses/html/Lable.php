<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class Lable extends baseHTMLElement {
	private $content,$id,$class;
	private $htmlcontent;
	/**
	 */
	function __construct($Content,$ID="Lable",$Class="Lable") {
		$this->content=$Content;
		$this->setId($ID);
		$this->setClass($Class);
		$this->setHtmlContent(true);
		
	}
	public function setHtmlContent($state)
	{
	$this->htmlcontent=$state;
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
		
		$html="<span ". $this->getAttributesDefinition() . ">" ;
		if($this->htmlcontent)
		$html.= htmlspecialchars($this->content) ;
		else
		$html.= $this->content;
		 $html.= "</span>";
		return $html;
	}

	public function getText()
	{
	    return $this->content;
	}

	public function setText($Text)
	{
	    $this->content = $Text;
	}
}

?>