<?php

namespace core\CoreClasses\html;

class PHPFile extends baseHTMLElement {
	private $Module,$Name,$Parameters;
	function __construct($Module,$Name)
	{
		$this->Module=$Module;
		$this->Name=$Name;
		$this->Parameters=array();
	}
	
	public function getHTML()
	{
	    $i=0;
	    for($i=0;$i<count($this->Parameters);$i++)
	    {
	        $param=$this->Parameters[$i]['name'];
	        $$param=$this->Parameters[$i]['value'];
	    }
		include (DEFAULT_APPPATH . "Modules/" . $this->Module . "/Files/PHP/" . $this->Name . ".php");
	}

	public function addParameter($ParameterName,$ParameterValue)
	{
	    $Parameter['name']=$ParameterName;
	    $Parameter['value']=$ParameterValue;
	    array_push($this->Parameters,$Parameter);
	}
}

?>