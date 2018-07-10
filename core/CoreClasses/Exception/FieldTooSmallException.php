<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class FieldTooSmallException extends SweetException {
	public function __construct($message = null, $code = 0, \Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("FieldTooSmallException:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>