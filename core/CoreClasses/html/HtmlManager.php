<?php

namespace core\CoreClasses\html;

/**
 *
 * @author hadi
 *        
 */
class HtmlManager {
	
	static function convert2Html($string)
	{
		$patterns = array();
		$patterns[0] = '/\n/';
		$replacements = array();
		$replacements[0] = '<br/>';
		return preg_replace($patterns, $replacements, $string);
	}
}

?>