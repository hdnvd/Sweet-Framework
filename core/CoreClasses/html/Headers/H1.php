<?php

namespace core\CoreClasses\html\Headers;

use core\CoreClasses\html\baseHTMLElement;
use core\CoreClasses\html\BaseHTMLTag;

/**
 *
 * @author nahavandi
 *        
 */
class H1 extends BaseHTMLTag {
	
	public function __construct($Content)
	{
		$this->setTag("H1");
		$this->setContent($Content);
		
	}
	public function setContent($Content)
	{
	    parent::setContent($Content);
	}
}

?>