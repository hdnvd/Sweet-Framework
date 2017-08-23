<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class CheckBoxOption extends HTMLInput {
	private $Text,$Checked;
	function __construct($name,$value="",$visible=true,$id=null,$class="checkbox",$readonly=false) 
	{
		parent::__construct($name,$value,$id,$class,$readonly);
		
		$this->setVisible($visible);
		$this->setType("checkbox");
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {
	    $html="<label>";
		if($this->Checked)
			$this->SetAttribute("checked", "checked");
		$html.=parent::getHTML();
		$html.=$this->Text ;
		$html.="</label>";
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