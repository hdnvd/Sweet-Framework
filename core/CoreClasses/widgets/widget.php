<?php

namespace core\CoreClasses\widgets;

use core\CoreClasses\db\dbquery;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\htmlcode;
/**
 *
 * @author Hadi AmirNahavandi
 *        
 */
class widget {
	private $title,$showTitle,$width,$height,$fields,$WidgetClass;
	public function __construct($WidgetID)
	{
		$Database=new dbquery();
		$result=$Database->Select("*")->From("widget")->Where()->Equal("id", $WidgetID)->Execute();
		if(is_null($result))
		{
			throw new \Exception("Widget Instance Not Found", "11474404");
		}
		else
		{
			$this->height=$result[0]->height;
			$this->width=$result[0]->width;
			$this->showTitle=$result[0]->showtitle;
			$this->title=$result[0]->title;
			$this->fields=$result[0]->fields;
			$Classresult=$Database->Select("*")->From("widgetclass")->Where()->Equal("id", $result[0]->widgetclass_fid)->Execute();
			if(is_null($Classresult))
			{
				throw new \Exception("Widget Class Not Found", "11475404");
			}
			else
			{
				$module=$Database->Select("*")->From("module")->Where()->Equal("id", $Classresult[0]->module_fid)->Execute();
				if(is_null($module))
				{
					throw new \Exception("Module Not Found", "11475404");
				}
				else
				{
					$this->WidgetClass="Modules\\" . $module[0]->name . "\\Forms\\" . $Classresult[0]->name . "_Code";
				}
			}
		}
	}
	public function getBodyHtml()
	{
	    $Widget=new Div();
	    $Widget->setClass("sweetwidget");
	    if($this->showTitle)
	    {
	       $WidgetTitleContainer=new Div();
	       $WidgetTitleContainer->setClass("sweetwidgettitle");
	       $WidgetTitle=new Lable($this->title);
	       $WidgetTitleContainer->addElement($WidgetTitle);
	       $Widget->addElement($WidgetTitleContainer);
	    }
	    $WidgetContentContainer=new Div();
	    $WidgetContentContainer->setClass("sweetwidgetcontent");
		if(!is_null($this->WidgetClass))
		{
			$widgetobject=new $this->WidgetClass($this->title,$this->fields,$this->showTitle,$this->width,$this->height);
			$WidgetContentContainer->addElement(new htmlcode($widgetobject->load()));
			$Widget->addElement($WidgetContentContainer);
			return $Widget;
		}
		else 
			throw new \Exception("Widget Not Found","11470404");
	}
}

?>