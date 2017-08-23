<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/07
*/
namespace core\CoreClasses\html;
abstract class baseHTMLElement {
	private $onclick,$id,$class,$style,$Name,$Attributes=array();
	public abstract function getHTML();
	public function show()
	{
		echo $this->getHTML();
	}
	public function __toString()
	{
		return $this->getHTML();
	}
	public function setOnClick($onClick)
	{
		$this->onclick=$onClick;
		$this->SetAttribute("onclick", $onClick);
	}
	protected function getOnClick()
	{
		return $this->getAttribute("onclick");
	}
	public function getId()
	{
	    return $this->getAttribute("id");
	}

	public function setId($id)
	{
	    $this->SetAttribute("id", $id);
	}

	public function getClass()
	{
	    return $this->getAttribute("class");
	}

	public function setClass($class)
	{
	    $this->SetAttribute("class", $class);
	}

	public function getStyle()
	{
		return $this->getAttribute("style");
	}

	public function setStyle($style)
	{
	    $this->SetAttribute("style", $style);
	}

	public function getName()
	{
		return $this->getAttribute("name");
	}

	public function setName($Name)
	{
	    $this->Name = $Name;
	    $this->SetAttribute("name", $Name);
	}
	protected function getPropertyDefinition($Property,$Value)
	{
		if(!is_null($Value))
			return " $Property=\"$Value\" ";
		else 
			return "";
	}
	public function SetAttribute($AttributeName,$Value)
	{
		$AttributeName=strtolower($AttributeName);
		$this->Attributes[$AttributeName]=$Value;
	}
	public function getAttribute($AttributeName)
	{
		if(key_exists($AttributeName, $this->Attributes))
			return htmlspecialchars($this->Attributes[$AttributeName]);
		else
			return null;
	}
	protected function getAttributesDefinition()
	{
		$html=" ";
		$keys=array_keys($this->Attributes);
		for($i=0;$i<count($keys);$i++)
		{
			$attr=$keys[$i];
			$html.=$this->getPropertyDefinition($attr, $this->getAttribute($attr));
		}
		return $html;
	}

}


?>