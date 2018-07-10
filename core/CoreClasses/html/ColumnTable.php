<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class ColumnTable extends baseHTMLElement {
	private $Columns,$ColumnInfos,$MaxRows;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function __construct()
	{
		$this->MaxRows=500;
	}
	public function AddColumn(array $ColumnData,ColumnInfo $ColumnInfo=null)
	{
		array_push($this->Columns, $ColumnData);
		array_push($this->ColumnInfos, $ColumnInfo);
	}
	
	public function getHTML() {
		$HTML="\n<table". $this->getPropertyDefinition("id", $this->getId()) . $this->getPropertyDefinition("class", $this->getClass()) . $this->getPropertyDefinition("style", $this->getStyle()) . ">";
	
		//Titles
		$HTML.=$this->getHeads();
	
		//Rows
		$RowsCount=max(array($this->getRowsCount(),$this->MaxRows));
		$HTML.=$this->getRows($RowsCount);
	
		$HTML.="\n</table>";
		return $HTML;
	}
	
	
	private function getRows($RowsCount)
	{
		$HTML.="<tr>";
		for($RowIndex=0;$RowIndex<$RowsCount;$RowIndex++)
		{
			for($ColumnIndex=0;!is_null($this->Columns) && $ColumnIndex<count($this->Columns);$ColumnIndex++)
			{
				if(!is_null($this->Columns[$ColumnIndex]))
					if($RowIndex<count($this->Columns[$ColumnIndex]))
						$HTML.="<td>" . $this->Columns[$ColumnIndex][$RowIndex] . "</td>";
					else 
						$HTML.="<td></td>";
				else 
					$HTML.="<td>NULL</td>";
			}
		}
		$HTML.="</tr>";
		return $HTML;
	}
	private function getHeads()
	{
		$HTML="<tr>";
		for($ColumnIndex=0;!is_null($this->ColumnInfos) && $ColumnIndex<count($this->ColumnInfos);$ColumnIndex++)
		{
		if(!is_null($this->ColumnInfos[$ColumnIndex]))
			$HTML.="<th>" . $this->ColumnInfos[$ColumnIndex]->getTitle() . "</th>";
		}
		$HTML.="</tr>";
		return $HTML;
	}
	private function getRowsCount()
	{
		$MaxCount=0;
		for($ColumnIndex=0;!is_null($this->Columns) && $ColumnIndex<count($this->Columns);$ColumnIndex++)
		{
			if(is_null($this->Columns[$ColumnIndex]))
				$MaxCount=0;
			else
			{
				$count=count($this->Columns[$ColumnIndex]);
				if($count>$MaxCount)
					$MaxCount=$count;
			}
		}
		return $MaxCount;
	}

	public function getMaxRows()
	{
	    return $this->MaxRows;
	}

	public function setMaxRows($MaxRows)
	{
	    $this->MaxRows = $MaxRows;
	}
}
class ColumnInfo
{
	private $Title;
	public function __construct($Title)
	{
		$this->setTitle($Title);
	}

	public function getTitle()
	{
	    return $this->Title;
	}

	public function setTitle($Title)
	{
	    $this->Title = $Title;
	}
}
?>