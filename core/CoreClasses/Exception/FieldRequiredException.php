<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class FieldRequiredException extends SweetException {
	public function __construct($message = null, $code = 0, \Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("FieldRequiredException:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>