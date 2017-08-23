<?php

namespace core\CoreClasses\html;

class form extends baseHTMLElement {
	private $element,$action,$method;
	/*
	 * @param baseHTMLElement element:element group or an Other baseHtmlElement Instance
	 * 
	 * 
	 */
	function __construct($action,$method,baseHTMLElement $element) 
	{
		$this->setAction($action);
		$this->setMethod($method);		
		$this->setElement($element);
	}
	
	public function getHTML() 
	{
		$html="\n<Form enctype=\"multipart/form-data\"".$this->getAttributesDefinition().">";
		$html.=$this->element;
		$html.="\n</Form>";
		return $html;
	}

	public function getElement()
	{
	    return $this->element;
	}

	public function setElement($element)
	{
	    $this->element = $element;
	}

	public function getAction()
	{
	    return $this->getAttribute("action");
	}

	public function setAction($action)
	{
	    $this->SetAttribute("action", $action) ;
	}

	public function getMethod()
	{
	    return $this->getAttribute("method");
	}

	public function setMethod($method)
	{
	    $this->SetAttribute("method", $method);
	}
}

?>