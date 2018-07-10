<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class SyntaxError extends SweetException {
	public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("SyntaxError:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>