<?php

namespace core\CoreClasses\Forms;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class FormInfo {
	private $Module,$Page,$Action;
	function __construct($Module,$Page,$Action) 
	{
		if(is_null($Module))
			$Module=DEFAULT_MODULE;
		if(is_null($Page))
			$Page=DEFAULT_PAGE;
		if(is_null($Action))
			$Action="load";
		$this->Module=$Module;
		$this->Page=$Page;
		$this->Action=$Action;
	}
	public function getModule()
	{
		return $this->Module;
	}
	public function getPage()
	{
		return $this->Page;
	}
	public function getAction()
	{
		return $this->Action;
	}
}

?>