<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class PageActionNotFoundException extends SweetException {
    private $Module,$Page,$Action;
	public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("PageActionNotFound:" . $message, $code, $previous,$ErrorMaker);
	}

	public function getModule()
	{
	    return $this->Module;
	}

	public function setModule($Module)
	{
	    $this->Module = $Module;
	}

	public function getPage()
	{
	    return $this->Page;
	}

	public function setPage($Page)
	{
	    $this->Page = $Page;
	}

	public function getAction()
	{
	    return $this->Action;
	}

	public function setAction($Action)
	{
	    $this->Action = $Action;
	}
}

?>