<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class SweetException extends \Exception
{  
    private   $ErrorMaker;         // previous exception if nested exception

    public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
    {
    	parent::__construct("SweetError:" .$message, $code,$previous);
    	$this->setErrorMaker($ErrorMaker);
    }
	
    public function getErrorMaker()
    {
        return $this->ErrorMaker;
    }

    public function setErrorMaker($ErrorMaker)
    {
        $this->ErrorMaker = $ErrorMaker;
    }

   
}

?>