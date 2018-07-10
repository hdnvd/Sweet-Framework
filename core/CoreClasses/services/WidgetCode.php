<?php
/*
*@Author:Hadi AmirNahavandi
*@Last Update:2014/5/06
*/
namespace core\CoreClasses\services;
use core\CoreClasses\Exception\WidgetFieldNotXMLException;
abstract class WidgetCode extends ModuleClass
{
	private $title;
	private $fields;
	private $width;
	private $height;
	private $showtitle;
	public function getWidth()
	{
		return $this->width;
	}
	public function getHeight()
	{
		return $this->height;
	}
	public function getShowtitle()
	{
		return $this->showtitle;
	}
	public function getTitle()
	{
		return $this->title;
	}
	public function getField($fieldName)
	{
	    if(trim($this->fields)!="")
	    {
	       $this->fields=trim($this->fields);
	       if(substr($this->fields,0,1)!="<")
	       {
	           throw new WidgetFieldNotXMLException();
	       }
	       else
	       {
	           $xml=simplexml_load_string($this->fields);
	           $xml=$xml->$fieldName;
	       }
	    }
		
		return $xml[0];
	
	}
	public function __construct($title,$fields,$showtitle,$width=null,$height=null)
	{
		$this->title=$title;
		$this->fields=$fields;
		$this->width=$width;
		$this->height=$height;
		$this->showtitle=$showtitle;
	}
	public abstract  function load();
		
}
?>