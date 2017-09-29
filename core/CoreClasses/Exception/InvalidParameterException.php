<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class InvalidParameterException extends SweetException {
	public function __construct($message = null, $code = 0, \Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("InvalidParameterException:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>