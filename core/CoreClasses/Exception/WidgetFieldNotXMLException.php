<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class WidgetFieldNotXMLException extends SweetException {
	public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
	{
	    $message="Widget Fields Should Be XML";
		parent::__construct($message, $code, $previous,$ErrorMaker);
	}
}

?>