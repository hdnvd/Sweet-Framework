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
	private $TagName="span";

    /**
     * @param string $TagName
     */
    protected function setTagName($TagName)
    {
        $this->TagName = $TagName;
    }
	/**
	 */
	function __construct($Content,$ID="Lable",$Class="Lable") {
		$this->content=$Content;
		$this->setId($ID);
		$this->setClass($Class);
		$this->setHtmlContent(true);
		$this->TagName="span";
		
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
		
		$html="<". $this->TagName . $this->getAttributesDefinition() . ">" ;
		if($this->htmlcontent)
        {
            $html.= htmlspecialchars($this->content);
            $html=str_replace("\n","</br>",$html);
        }
		else
		$html.= $this->content;
		 $html.= "</". $this->TagName . ">";
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