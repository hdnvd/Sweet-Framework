<?php

namespace core\CoreClasses\html;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.2
 * @lastUpdate  2016-05-22      
 */
class FileUploadBox extends HTMLInput {
	private $FileTypes,$IsMultiselectable;
	public function __construct($name,$text="",$id=null,$class="input",$readonly=false)
	{
		parent::__construct($name,$text,$id,$class,$readonly);
		$this->setIsMultiselectable(false);
		parent::setType("file");
	}
	public function getFileTypes()
	{
	    return $this->FileTypes;
	}

	public function setFileTypes($FileTypes)
	{
	    $this->FileTypes = $FileTypes;
	    parent::addAdditonalAttr("accept=\"$FileTypes\"");
	}
	public function getSelectedFilesName()
	{
	    $ResFileNames=array();
	    $FileNames=$_FILES[$this->getName()];
	    if(is_array($FileNames['name']))
	        $ResFileNames=$FileNames['name'];
	    else 
	        $ResFileNames[0]=$FileNames['name'];
	    return $ResFileNames;
	}
    public function getSelectedFilesType()
    {
        $ResFileNames=array();
        $FileNames=$_FILES[$this->getName()];
        if(is_array($FileNames['name']))
            $ResFileNames=$FileNames['type'];
        else
            $ResFileNames[0]=$FileNames['type'];
        return $ResFileNames;
    }
	public function getSelectedFilesTempPath()
	{
	    $ResFileNames=array();
	    $FileNames=$_FILES[$this->getName()];
	    if(is_array($FileNames['tmp_name']))
	        $ResFileNames=$FileNames['tmp_name'];
	    else 
	        $ResFileNames[0]=$FileNames['tmp_name'];
	    return $ResFileNames;
	}

	public function getIsMultiselectable()
	{
	    return $this->IsMultiselectable;
	}

	public function setIsMultiselectable($IsMultiselectable)
	{
	    $Name=$this->getName();
	    $NameLength=strlen($Name);
	    if($IsMultiselectable)//Is Being Multiselectable
	    {

            parent::addAdditonalAttr("multiple");
	       if(substr($Name,$NameLength-3,2) !="[]")
	           $this->setName($this->getName() . "[]");
	    }
	    else if(!$IsMultiselectable)//Is Being Not Multiselectable
	    {

	       if(substr($Name,$NameLength-3,2) =="[]")
	           $this->setName(substr($Name,0,$NameLength-2));
	    }
	    
	    $this->IsMultiselectable = $IsMultiselectable;
	}
}

?>