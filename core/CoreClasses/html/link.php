<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/07
*/
namespace core\CoreClasses\html;

class link extends baseHTMLElement{
	private $content,$showMode;
	public function __construct($Link,$content,$id='link',$class='link',$showMode=\core\deviceinterface::WEBBROWSER)
	{
		$this->SetLink($Link);
		$this->content=$content;
		$this->showMode=$showMode;
		$this->setClass($class);
		$this->setId($id);
		
	}
	public function getHTML()
	{
		$html="<a".$this->getAttributesDefinition().">" . $this->content . "</a>";
		return $html;
	}
	public function SetLink($Link)
	{
		$this->SetAttribute("href", $Link);
	}
	public function GetLink()
	{
		return $this->getAttribute("href");
	}
}

?>