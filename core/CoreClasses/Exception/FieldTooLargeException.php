<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class FieldTooLargeException extends SweetException {
	public function __construct($message = null, $code = 0, \Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("FieldTooLargeException:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>