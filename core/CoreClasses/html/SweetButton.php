<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class SweetButton extends Button {
	private $action;
	

	public function setAction($action)
	{
	    $this->action = $action;
	    
	    $this->setOnClick("var t='#'+$(this).closest('form').attr('id')+' #action';$(t).val('$action"."_Click');");
	}
}

?>