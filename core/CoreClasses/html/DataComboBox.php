<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/07
*/
namespace core\CoreClasses\html;

class DataComboBox extends baseHTMLElement{
	private $html,$id,$name,$dataArray,$class,$selectedid,$IDField,$TextField;
	public function __construct($dataArray,$name="combobox",$id=null,$class=null,$IDField="id",$TextField="text")
	{	
		if(is_null($id))
			$id=$name;
		if(is_null($class))
			$class=$id;
		$this->setId($id);
		$this->setName($name);
		$this->setClass($class);
		$this->dataArray=$dataArray;
		$this->setIDField($IDField);
		$this->setTextField($TextField);
	}
	public function setSelectedID($selectedid)
	{
		$this->selectedid=$selectedid;
	}
	public function getSelectedID()
	{
		if(isset($_POST[$this->getName()]))
			return $_POST[$this->getName()];
		else 
			return $this->selectedid;
	}
	public function getHTML()
	{

		
		$html="\n<select " . $this->getAttributesDefinition() . " >";
		if(is_array($this->dataArray))
		{
			$idIndex=$this->IDField;
			$textIndex=$this->TextField;
			//Checking Indexes For Text And Id(If Keys Not Found index 0 is ID and index 1 Is Text)
			if(count($this->dataArray)>0)
			{
				
				if(is_array($this->dataArray[0]) && count($this->dataArray[0])>=2)
				{
					if(!key_exists($textIndex,$this->dataArray[0]) || !key_exists($idIndex,$this->dataArray[0]))
					{
						
						$keys=array_keys($this->dataArray[0]);
						
						$idIndex=$keys[0];
						$textIndex=$keys[1];
						
					}
					for($i=0;$i<count($this->dataArray);$i++)
					{
						$selected="";
						if($this->dataArray[$i][$idIndex]==$this->selectedid)
							$selected=" selected=\"selected\" ";
							$html.="\n<option $selected value=\"" . $this->dataArray[$i][$idIndex] . "\">" . $this->dataArray[$i][$textIndex] . "</option>";
					}
				}
				
					
				
				
				
			}
			//END OF Checking Indexes For Text And Id
			
			
			
		}
		$html.="\n</select>";
		return $html;
	}


	public function setIDField($IDField)
	{
	    $this->IDField = $IDField;
	}
	
	public function setTextField($TextField)
	{
	    $this->TextField = $TextField;
	}

	public function setDataArray($dataArray)
	{
	    $this->dataArray = $dataArray;
	}
}

?>