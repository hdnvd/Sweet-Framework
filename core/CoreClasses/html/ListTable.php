<?php

namespace core\CoreClasses\html;

/**
 *
 * @author hadi Nahavandi
 * @version 0.2
 * @lastUpdate 2016/6/16 19:08
 *        
 */
class ListTable extends baseHTMLElement {
	
	
	private $ColumnsCount,$elements,$elementColspans,$elementStyles,$elementClasses,$elementIDs;
	private $HeaderRowCount;

    /**
     * @param int $HeaderRowCount
     */
    public function setHeaderRowCount($HeaderRowCount)
    {
        $this->HeaderRowCount = $HeaderRowCount;
    }
	/**
	 * 
	 * @param int $ColumnsCount
	 */
	function __construct($ColumnsCount) 
	{
		$this->setColumnsCount($ColumnsCount);
		$this->elements=array();
		$this->elementColspans=array();
		$this->elementStyles=array();
		$this->elementClasses=array();
		$this->elementIDs=array();
		$this->HeaderRowCount=0;
	}
	function setElementsGroup(elementGroup $ElementsGroup)
	{
		$this->elements=$ElementsGroup->getElements();
	}
	/**
	 *
	 * @param int $ColumnsCount
	 */
	public function setColumnsCount($ColumnsCount)
	{
		$this->ColumnsCount=$ColumnsCount;
	}
	/**
	 * @tutorial adds An Element To Queu
	 * @param baseHTMLElement $Element
	 */
	public function addElement(baseHTMLElement $Element,$Colspan=1)
	{
		array_push($this->elements,$Element);
		array_push($this->elementColspans,$Colspan);
	}
	public function setLastElementID($ID)
	{
		$this->elementIDs[count($this->elements)-1]=$ID;
	}
	public function setLastElementClass($Class)
	{
		$this->elementClasses[count($this->elements)-1]=$Class;
	}
	public function setLastElementStyle($Style)
	{
		$this->elementStyles[count($this->elements)-1]=$Style;
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function getHTML() {

		$elementsCount=count($this->elements);
		$code="\n<table ".$this->getAttributesDefinition().">";
		$collumnNumber=0;
		$RowNumber=0;
		for($i=0;$i<$elementsCount;$i++)
		{
		    if($collumnNumber==0)
			     $code.="\n\t<tr>";
		    if($RowNumber<$this->HeaderRowCount)
		        $itemTag="th";
		    else
                $itemTag="td";

			$tmpcolspan="";
			$tmpID="";
			$tmpClass="";
			$tmpStyle="";
			if($this->elementColspans[$i]>=1)
				$tmpcolspan=" colspan=\"" . $this->elementColspans[$i] ."\"";
			if($this->elementIDs!==null && key_exists($i, $this->elementIDs) &&  !is_null($this->elementIDs[$i]))
				$tmpID=" id=\"" . $this->elementIDs[$i] ."\"";
			if(!is_null($this->elementClasses) &&  key_exists($i, $this->elementClasses) &&  !is_null($this->elementClasses[$i]))
				$tmpClass=" class=\"" . $this->elementClasses[$i] ."\"";
			if(!is_null($this->elementStyles) && key_exists($i, $this->elementStyles) && !is_null($this->elementStyles[$i]))
				$tmpStyle=" style=\"" . $this->elementStyles[$i] ."\"";
				
			$code.="\n\t\t<" . $itemTag." $tmpcolspan $tmpStyle $tmpClass $tmpID>" . $this->elements[$i] . "</" . $itemTag . ">";
			$collumnNumber+=$this->elementColspans[$i];
		    if($collumnNumber>=$this->ColumnsCount)
		    {
		         $collumnNumber=0;
                $RowNumber++;
			     $code.="\n\t</tr>";
		    }
		}
		if($collumnNumber!=0)
		{
		    $csp=$this->ColumnsCount-$collumnNumber;
		    $code.="\n\t\t<td colspan='$csp'></td></tr>";
		    
		}
		$code.="\n</table>";
		return $code;
	}
}

?>