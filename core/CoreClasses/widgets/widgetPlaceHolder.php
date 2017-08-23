<?php

namespace core\CoreClasses\widgets;

use core\CoreClasses\db\dbquery;
/**
 *
 * @author nahavandi
 *        
 */
class widgetPlaceHolder {
	private $PlaceID,$PlaceName;
	
	/**
	 */
	function __construct($PlaceName) 
	{
		$this->PlaceName=$PlaceName;
		$Database=new dbquery();
		$widget=$Database->Select("id")->From("widgetplace")->Where()->Equal("name", $PlaceName)->Execute();
		if(is_null($widget))
			throw new \Exception("Widget Place Not Found","11470404");
		else 
			$this->PlaceID=$widget[0]->id;
	}
	public function getBodyHTML()
	{
		$Database=new dbquery();
		$widgets=$Database->Select("id")->From("widget")->Where()->Equal("widgetplace_fid", $this->PlaceID)->Execute();
		if(!is_null($widgets))
		{
			$html="";
			for($i=0;$i<count($widgets);$i++)
			{
				$tmpWidget=new widget($widgets[$i]->id);
				$html.=$tmpWidget->getBodyHtml();
			}
			return $html;
		}
		else 
			return "";
	}
}

?>