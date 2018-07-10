<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class InvalidFieldException extends SweetException {
	public function __construct($message = null, $code = 0, \Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("InvalidFieldException:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>