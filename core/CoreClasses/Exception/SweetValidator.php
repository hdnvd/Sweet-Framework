<?php

namespace core\CoreClasses\Exception;

/**
 *
 * @author nahavandi
 *        
 */
class SweetValidator {
	const MATCHED=0;
	const ERROR_NOT_NUMERIC=1;
	const ERROR_NOT_IN_NUMERIC_RANGE=2;
	const ERROR_NOT_MATCHED_REGEX=3;
	const ERROR_LENGTH_NOT_IN_RANGE=4;
	public static function isEmail($Parameter)
	{
		return filter_var($Parameter, FILTER_VALIDATE_EMAIL);
	}
	public static function isURL($Parameter)
	{
		return filter_var($Parameter, FILTER_VALIDATE_URL);
	}
	public static function isIP($Parameter)
	{
		return filter_var($Parameter, FILTER_VALIDATE_IP);
	}
	public function Validate($Parameter,$Regex,$IsNumeric,$Min,$Max)
	{
		//echo "<p>ISNUMERIC:$IsNumeric , PARAMETER:$Parameter , REGEX:$Regex</p>";
		$Parameter=trim($Parameter);
		if($IsNumeric==1)
		{
			if(is_numeric($Parameter))
				if($Parameter>=$Min && $Parameter<=$Max)
					return SweetValidator::MATCHED;
				else 
				{
					//echo $Parameter . "--" . $Min . "--" . $Max . "<br>";
					return SweetValidator::ERROR_NOT_IN_NUMERIC_RANGE;
				}
			else 
			{
				
				return SweetValidator::ERROR_NOT_NUMERIC;
			}
		}
		else 
		{
			
			$Length=strlen($Parameter);
			if($Length>=$Min && $Length<=$Max)
				if(preg_match($Regex, $Parameter))
					
					return SweetValidator::MATCHED;
				else 
				{
					return SweetValidator::ERROR_NOT_MATCHED_REGEX;
				}
			else return SweetValidator::ERROR_LENGTH_NOT_IN_RANGE;
				
			
		}
		return false;
	}
}

?>