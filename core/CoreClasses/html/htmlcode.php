<?php

namespace core\CoreClasses\html;
/**
 * @deprecated Use Of This Element Is Deprecated
 * 
 */
class htmlcode extends baseHTMLElement {
	private $html;
	function __construct($html) 
	{
		$this->html=$html;
	}
	public function getHTML() 
	{
		return $this->html;
	}
}

?>