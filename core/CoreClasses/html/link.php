<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/07
*/
namespace core\CoreClasses\html;

use core\deviceinterface;

class link extends baseHTMLElement{
	private $content,$showMode;
	private $glyphiconClass;

    /**
     * @param mixed $glyphiconClass
     */
    public function setGlyphiconClass($glyphiconClass)
    {
        $this->glyphiconClass = $glyphiconClass;
    }
	public function __construct($Link,$content,$id='link',$class='link',$showMode=deviceinterface::WEBBROWSER)
	{
		$this->SetLink($Link);
		$this->content=$content;
		$this->showMode=$showMode;
		$this->setClass($class);
		if($id!=null)
		    $this->setId($id);
		$this->setGlyphiconClass(null);
		
	}
	public function getHTML()
	{
        $glyphicon="";
	    if($this->glyphiconClass!=null)
            $glyphicon="<i class='" . $this->glyphiconClass . "'></i>";
		$html="<a".$this->getAttributesDefinition().">" .$glyphicon  . $this->content  . "</a>";
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