<?php

namespace core\CoreClasses\html;

class Image extends baseHTMLElement {
	private $url,$width,$height,$altText,$id,$class;
	function __construct($url,$altText="Image",$width=null,$height=null,$id="Image",$class=null) 
	{
		$this->setId($id);
		if(is_null($class))
			$class=$id;
		$this->setClass($class);
		$this->setUrl($url);
		$this->SetAttribute("alttext", $altText);
		$this->SetAttribute("width", $width);
		$this->SetAttribute("height", $height);
	}
	public function getHTML() 
	{
		$html="<img ".$this->getAttributesDefinition()." />";
		return $html;
	}
	public function getUrl()
	{
		return $this->getAttribute("src");
	}
	public function setUrl($Url)
	{
		return $this->SetAttribute("src", $Url);
	}
}

?>