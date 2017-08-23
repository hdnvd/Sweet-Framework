<?php

namespace core\CoreClasses;

/**
 *
 * @author nahavandi
 *        
 */
class sweetArray {
	public static function FindInArray($Value,$Array)
	{
		$Value=trim($Value);
		for($i=0;$i<count($Array);$i++)
		{
			if(trim($Array[$i])==$Value)
				return $i;
		}
		return -1;
	}
}

?>