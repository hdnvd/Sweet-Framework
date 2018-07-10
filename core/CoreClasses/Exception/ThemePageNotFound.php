<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class ThemePageNotFound extends SweetException {
    private $ThemePage;
    private $ThemePageFileURL;
	public function __construct($message = null, $code = 0, Exception $previous = null,$ErrorMaker="unknown")
	{
		parent::__construct("ThemePageNotFound:" . $message, $code, $previous,$ErrorMaker);
	}


	public function getThemePage()
	{
	    return $this->ThemePage;
	}

	public function setThemePage($ThemePage)
	{
	    $this->ThemePage = $ThemePage;
	}

	public function getThemePageFileURL()
	{
	    return $this->ThemePageFileURL;
	}

	public function setThemePageFileURL($ThemePageFileURL)
	{
	    $this->ThemePageFileURL = $ThemePageFileURL;
	}
}

?>