<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class FileExistsError extends SweetException {
	public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("FileExistsError:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>