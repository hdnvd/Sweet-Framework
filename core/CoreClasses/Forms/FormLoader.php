<?php

namespace core\CoreClasses\Forms;

use core\CoreClasses\services\FormCode;
use core\CoreClasses\Exception\PageActionNotFoundException;
/**
 *
 * @author Hadi Nahavandi
 * @version 0.2
 * LastUpdate 93/08/23
 *        
 */
class FormLoader {
	private $FormInfo,$PageClass,$PageObject;
	
	/**
	 */
	function __construct(FormInfo $Info) 
	{
		$this->FormInfo=$Info;
		$this->PageClass="Modules\\" . $Info->getModule() . "\\Forms\\" . $Info->getPage() ."_Code";
		$this->PageObject=null;
		if(class_exists($this->PageClass))
			$this->PageObject=new $this->PageClass($this->FormInfo->getModule());
		else
		{
			header('location:/404Error/' . $Info->getModule() . "/" . $Info->getPage());
		}
		
	}
	public function getResponse()
	{
		$action=$this->FormInfo->getAction();
		if(method_exists($this->PageObject,$action))
			return $this->PageObject->$action();
		else
			throw new PageActionNotFoundException("Page Action $action Not Found!", "11473404");
	}
	/**
	 * @return FormCode <unknown, NULL>
	 */
	public function &getForm()
	{
		return $this->PageObject;
	}
}

?>