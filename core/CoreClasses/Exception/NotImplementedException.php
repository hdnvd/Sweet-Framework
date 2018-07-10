<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class NotImplementedException extends SweetException {
	public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("NotImplementedException:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>