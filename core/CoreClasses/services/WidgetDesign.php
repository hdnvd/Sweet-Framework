<?php
/*
*@Author:Hadi AmirNahavandi
*@Last Update:2014/5/06
*/
namespace core\CoreClasses\services;
abstract class WidgetDesign extends ModuleClass
{
	private $title;
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
	public abstract  function getBodyHTML();
	public function __set($name, $value)
	{
		$methodName="set" . ucwords($name);
		if(!method_exists($this,$methodName))
			$this->data[$name] = $value;
		else
			throw new \Exception("Access To Parameter $name Denied!");
	}
	
	public function __get($name)
	{
		$methodName="set" . ucwords($name);
		if(!method_exists($this,$methodName))
		{
			if (array_key_exists($name, $this->data))
			{
				return $this->data[$name];
			}
			return "";
		}
		else
			throw new \Exception("Access To Parameter $name Denied!");
	}
		

	public function setTitle($title)
	{
	    $this->title = $title;
	}

	public function setWidth($width)
	{
	    $this->width = $width;
	}

	public function setHeight($height)
	{
	    $this->height = $height;
	}

	public function setShowtitle($showtitle)
	{
	    $this->showtitle = $showtitle;
	}
}
?>