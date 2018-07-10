<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class CheckListBox extends baseHTMLElement {
	private $DataArray,$Name,$ColumnsCount;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function __construct($Name,$ColumnsCount=1)
	{
		$this->setName($Name);
		$this->setColumnsCount($ColumnsCount);
	}
	public function getHTML() {
		$CheckList=new ListTable($this->ColumnsCount);
		for($i=0;$i<count($this->DataArray);$i++)
		{
			$chk=new CheckBox($this->Name);
			$chk->setText($this->DataArray[$i]['text']);
			$chk->setValue($this->DataArray[$i]['value']);
			$CheckList->addElement($chk);
		}
		return $CheckList->getHTML();
		
	}

	public function setDataArray($DataArray)
	{
	    $this->DataArray = $DataArray;
	}

	public function setName($Name)
	{
	    $this->Name = $Name . "[]";
	}

	public function setColumnsCount($ColumnsCount)
	{
	    $this->ColumnsCount = $ColumnsCount;
	}
}

?>