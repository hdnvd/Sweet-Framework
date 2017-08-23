<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class RadioBox extends baseHTMLElement {
	private $Text;
	private $OptionTexts;
	private $OptionValues;
	private $AddToNewLines;
	private $SelectedOption;
	private $SelectedValue;
	function __construct($name) 
	{
		$this->setName($name);
		$this->OptionTexts=array();
		$this->AddToNewLines=array();
		$this->OptionValues=array();
		$this->SelectedOption=0;
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
		$total="";
		for($i=0;$i<count($this->OptionTexts);$i++)
		{
			
			$o=new RadioBoxOption($this->getName());
			$o->setId($this->getId());
			if($this->OptionValues[$i]==$this->SelectedValue || $i==$this->SelectedOption)
				$o->setChecked(true);
			$o->setText($this->OptionTexts[$i]);
			$o->setValue($this->OptionValues[$i]);
			if($this->AddToNewLines[$i]==true)
				$total.="<br>";
			$total.="\n" . $o->getHTML();
		}
		return $total;
	}
	public function addOption($Text,$Value,$AddToNewLine=false)
	{
		array_push($this->OptionTexts,$Text);
		array_push($this->AddToNewLines,$AddToNewLine);
		array_push($this->OptionValues,trim($Value));
	}
	public function setSelectedOption($SelectedOption)
	{
	    $this->SelectedOption = $SelectedOption;
	    if($SelectedOption!=-1)
	    	$this->setSelectedValue(null);
	}
	public function setSelectedValue($SelectedValue)
	{
		$this->SelectedValue = trim($SelectedValue);
		if(!is_null($SelectedValue))
			$this->setSelectedOption(-1);
	}

    public function getSelectedValue()
    {
        if(isset($_POST[$this->getName()]))
            return $_POST[$this->getName()];
        else
            return $this->SelectedValue;
    }
}

?>