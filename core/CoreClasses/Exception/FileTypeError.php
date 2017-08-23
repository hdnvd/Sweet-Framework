<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class FileTypeError extends SweetException {
	public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("FileTypeError:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>