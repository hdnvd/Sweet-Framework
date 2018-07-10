<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class RadioBoxOption extends HTMLInput {
	private $Text,$Checked;
	function __construct($name,$value="",$visible=true,$id=null,$class="radiobox",$readonly=false) 
	{
		parent::__construct($name,$value,$id,$class,$readonly);
		$this->setVisible($visible);
		$this->setType("radio");
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
		if($this->Checked)
			$this->setAdditonalAttr(" checked=\"checked\"");
		$html=parent::getHTML() ;
		$html.=$this->Text;
		return $html;
	}
	public function setText($Text)
	{
	    $this->Text = $Text;
	}


	public function setChecked($Checked)
	{
	    $this->Checked = $Checked;
	}
}

?>