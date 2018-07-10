<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class SweetImageButton extends HTMLInput {
	private $action;

	function __construct($ImageSource,$Name="ImageButton",$Value="",$ID=null,$Class="ImageButton")
	{
		parent::__construct($Name,$Value,$ID,$Class);
		$this->setType("image");
		$this->SetAttribute("src", $ImageSource);
	}

	public function setAction($action)
	{
	    $this->action = $action;
	    
	    $this->setOnClick("var t='#'+$(this).closest('form').attr('id')+' #action';$(t).val('$action"."_Click');");
	}
}

?>