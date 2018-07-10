<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class DirectoryNotExistsError extends SweetException {
	public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("DirectoryNotExistsError:" . $message, $code, $previous,$ErrorMaker);
	}
}

?>