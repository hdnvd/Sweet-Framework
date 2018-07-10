<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class SweetFrom extends form {
	public function getHTML() 
	{
		if(is_null($this->getId()))
			$this->setId("sweetform");
		$element2=new TextBox("action","load",false,"action");
		$html="\n<Form enctype=\"multipart/form-data\"".$this->getAttributesDefinition()." >";
		$html.=$element2;
		$html.=$this->getElement();
		$html.="\n</Form>";
		return $html;
		
	}
	
}

?>