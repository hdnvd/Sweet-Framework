<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/07
*/
namespace core\CoreClasses\html;

class DataTable extends baseHTMLElement{
	private $html,$id,$titles,$dataArray,$class,$ActiveFields;
	public function __construct($dataArray,$name="table",$id="table",$class="table")
	{
		$this->id=$id;
		$this->name=$name;
		$this->class=$class;
		$this->dataArray=$dataArray;
		if(count($this->dataArray)>0 && is_array($this->dataArray[0]))
		{
			$this->titles=array_keys($this->dataArray[0]);
			$this->setActiveFields(array_keys($this->dataArray[0]));
		}
	}
	public function setTitles($titles)
	{
		$this->titles=$titles;
	}
	public function getHTML()
	{
		$html="\n<table " . $this->getAttributesDefinition() . " >";
		if(count($this->dataArray)>0 && is_array($this->dataArray[0]))
		{
			$fields=$this->ActiveFields;
			
			//title
			$html.="\n<tr>\n";
			for($j=0;$j<count($this->titles);$j++)
			{
				$html.="<th>" . $this->titles[$j] . "</th>";
			}
			$html.="\n</tr>";
			//eof title
				
			//data
			for($i=0;$i<count($this->dataArray);$i++)
			{
				$html.="\n<tr>\n";
				
				for($j=0;$j<count($fields);$j++)
				{
					$field=$fields[$j];
					if(array_key_exists($field,$this->dataArray[$i]))
						$tmpcontent=$this->dataArray[$i][$field];
					else
						$tmpcontent="";
					$html.="<td>" . $tmpcontent . "</td>";
				}
				$html.="\n</tr>";
			}
			//eof title
			
			
			
		}
		$html.="\n</table>";
		return $html;
	}

	public function getActiveFields()
	{
	    return $this->ActiveFields;
	}

	public function setActiveFields($ActiveFields)
	{
	    $this->ActiveFields = $ActiveFields;
	}
}

?>