<?php

namespace core\CoreClasses\html;

class Button extends baseHTMLElement {
	private $class,$name,$text,$id,$isSubmit,$type;
    private $glyphiconClass;
    private $DisplayMode;

    /**
     * @param int $DisplayMode
     */
    public function setDisplayMode($DisplayMode)
    {
        $this->DisplayMode = $DisplayMode;
    }
    public static $DISPLAYMODE_INPUT=1;
    public static $DISPLAYMODE_BUTTON=2;

    /**
     * @param mixed $glyphiconClass
     */
    public function setGlyphiconClass($glyphiconClass)
    {
        $this->glyphiconClass = $glyphiconClass;
    }
	function __construct($issubmit=true,$text="Button",$name=null,$id=null,$class=null)
	{
	    $this->setDisplayMode(Button::$DISPLAYMODE_INPUT);
		$this->isSubmit=$issubmit;
		
		if(is_null($name))
			$name="btnnoname";
		if(is_null($id))
			$id=$name;
		if(is_null($class))
			$class=$id;


        $this->setGlyphiconClass(null);
		$this->setName($name);
		$this->SetAttribute("value", $text);
		$this->setId($id);
		$this->setClass($class);
	}
	public function getHTML()
	{

        $glyphicon="";
        if($this->glyphiconClass!=null)
            $glyphicon="<i class='" . $this->glyphiconClass . "'></i>";
		if(!$this->isSubmit)
			$this->setType("button");
		else
			$this->setType("submit");
		if($this->DisplayMode==Button::$DISPLAYMODE_INPUT)
        {
            $html="<input ";
            $html.=$this->getAttributesDefinition() . " />";
        }
        else
        {
            $html="<button ";
            $html.=$this->getAttributesDefinition() . " >";
            if($glyphicon!="")
                $html.="\n " . $glyphicon;
            $html.="\n " . $this->getAttribute("value");
            $html.="</button>";
        }
		return $html;
	}

	protected function getType()
	{
	    return $this->getAttribute("type");
	}

	protected function setType($type)
	{
	   
		$this->SetAttribute("type", $type);
	}
}

?>