<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 * @lastUpdate 2015/06/28      
 */
class PasswordBox extends HTMLInput {
	function __construct($name,$text="",$visible=true,$id=null,$class="password",$readonly=false) 
	{
		parent::__construct($name,$text,$id,$class,$readonly);
		$this->setVisible($visible);
		$this->setType("password");
	}

	public function getValue()
	{
	    if(isset($_POST[$this->getName()]))
	        return $_POST[$this->getName()];
	    else
	       return $this->getAttribute("value");
	}
}
?>