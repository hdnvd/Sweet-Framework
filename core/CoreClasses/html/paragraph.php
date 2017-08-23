<?php

namespace core\CoreClasses\html;

class paragraph extends baseHTMLElement {
	private $content,$id,$class;
	
	function __construct($content="",$id="p",$class="p") 
	{
		$this->content=$content;
		$this->setClass($class);
		$this->setId($id);
	}
	public function getHTML() 
	{
		$html="<p ".$this->getAttributesDefinition().">" . HtmlManager::convert2Html($this->content) . "</p>";
		return $html;
	}
}

?>