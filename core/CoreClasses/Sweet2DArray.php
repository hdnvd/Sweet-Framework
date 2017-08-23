<?php

namespace core\CoreClasses;

class Sweet2DArray 
{
	public static function array_filp($array)
	{
		if(!is_null($array) && is_array($array) && count($array)>0)
		{
			$fields=array_keys($array[0]);
			$newarray=null;
			for($i=0;$i<count($array);$i++)
			{
				for($keyindex=0;$keyindex<count($array[0]);$keyindex++)
				{
					$key=$fields[$keyindex];
					$newarray[$key][$i]=$array[$i][$key];
				}
			}
			return $newarray;
		}
		else 
			return null;
	}
}

?>