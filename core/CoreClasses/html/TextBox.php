<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/07
*/
namespace core\CoreClasses\html;

class TextBox extends HTMLInput {
	function __construct($Name,$Text=null,$Visible=true,$ID=null,$Class="textbox",$ReadOnly=false) 
	{
	    if(isset($_POST[$Name]))
	        $Text=$_POST[$Name];
	    elseif($Text===null)
				$Text="";
		parent::__construct($Name,$Text,$ID,$Class,$ReadOnly);
		$this->setVisible($Visible);
		$this->setType("text");
	}
}

?>