<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class ComboBox extends baseHTMLElement {
	private $Options;
	private $OptionValues;
    private $GroupItemsValues;
    private $GroupItemsIndexes;
	private $OptionClasses;
	private $OptionIDs;
	private $selectedID;
	private $name;
	private $selectedValue;
	private $Multiselectable;
	private $MotherComboboxName;
	private $MotherComboboxAutoLoadMode;
    private $DataLoadJSONURL;

    /**
     * @return mixed
     */
    public function getDataLoadJSONURL()
    {
        return $this->DataLoadJSONURL;
    }

    /**
     * @param mixed $DataLoadJSONURL
     */
    public function setDataLoadJSONURL($DataLoadJSONURL)
    {
        $this->DataLoadJSONURL = $DataLoadJSONURL;
    }

    /**
     * @return int
     */
    public function getMotherComboboxAutoLoadMode()
    {
        return $this->MotherComboboxAutoLoadMode;
    }

    /**
     * @param int $MotherComboboxAutoLoadMode
     */
    public function setMotherComboboxAutoLoadMode($MotherComboboxAutoLoadMode)
    {
        $this->MotherComboboxAutoLoadMode = $MotherComboboxAutoLoadMode;
    }
	public static $AUTOLOADMODE_ONPAGE=1;
    public static $AUTOLOADMODE_AJAX=2;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function __construct($name)
	{
		$this->OptionClasses=array();
		$this->OptionIDs=array();
		$this->Options=array();
		$this->OptionValues=array();
        $this->OptionGroupValues=array();
        $this->GroupItemsIndexes[-1]=array();
        $this->GroupItemsValues[-1]=array();
		$this->selectedValue=null;
		$this->Multiselectable=false;
		$this->MotherComboboxName=null;
		$this->setName($name);
		$this->setId($name);
		$this->MotherComboboxAutoLoadMode=ComboBox::$AUTOLOADMODE_ONPAGE;
		$this->DataLoadJSONURL=null;
	}

    /**
     * @param string $MotherComboboxName
     */
    public function setMotherComboboxName($MotherComboboxName)
    {
        $this->MotherComboboxName = $MotherComboboxName;
    }

	public function getSelectedID()
	{
	    if(isset($_POST[$this->getName()]))
	        return $_POST[$this->getName()];
	    else
	        return $this->selectedID;
	}
	public function addOption($Value,$Text,$Class="",$ID="")
	{
		array_push($this->OptionValues, trim($Value));
		array_push($this->Options, $Text);
		array_push($this->OptionClasses, $Class);
		array_push($this->OptionIDs, $ID);
        array_push($this->GroupItemsIndexes[-1],count($this->Options)-1);
        array_push($this->GroupItemsValues[-1],$Value);
	}
    public function addGroupedOption($GroupValue,$Value,$Text,$Class="",$ID="")
    {
        $this->addOption($Value,$Text,$Class,$ID);
        if(!key_exists($GroupValue,$this->GroupItemsIndexes)){
            $this->GroupItemsIndexes[$GroupValue]=array();
            $this->GroupItemsValues[$GroupValue]=array();

        }
        array_push($this->GroupItemsIndexes[$GroupValue],count($this->Options)-1);
        array_push($this->GroupItemsValues[$GroupValue],$Value);
    }
	public function getHTML()
	{
		$html="\n<select".$this->getAttributesDefinition()." ";
		if($this->Multiselectable)
		    $html.="multiple ";
		$html.=">";
        $GroupIDs=array_keys($this->GroupItemsIndexes);
        for($i=0;$i<count($GroupIDs);$i++)
            $html.=$this->getGroupOptions($GroupIDs[$i]);
		$html.="\n</select>";
        $html.=$this->getGroupIDs();
		return $html;
	}
	private function getGroupOptions($GroupID)
    {
        $optIDs=$this->GroupItemsIndexes[$GroupID];
        $html="";
        //$html="<optgroup label=\"$GroupID\">";
        for($i=0;$i<count($optIDs);$i++)
        {
            $OptionID=$optIDs[$i];
            $tmpOption=$this->Options[$OptionID];
            $tmpValue=$this->OptionValues[$OptionID];
            $tmpID=$this->OptionIDs[$OptionID];
            $tmpClass=$this->OptionClasses[$OptionID];
            $id="";
            $class="";
            $selected="";
            if($tmpClass!="")
                $class="class=\"$tmpClass\"";
            if($tmpID!="")
                $id="id=\"$tmpID\"";
            if($tmpValue==$this->selectedValue)
                $selected=" selected=\"selected\" ";
            $html.="\n\t<option $selected value=\"$tmpValue\" $id $class>$tmpOption</option>";

        }
       // $html.="</optgroup>";
        return $html;
    }
	private function getGroupIDs()
    {
        $groups=array_keys($this->GroupItemsValues);
        $html="<script language='javascript'>";
        $varName=$this->getName() . "groupIDs";
        $html.="var $varName=[";
        for($i=0;$i<count($groups);$i++)
        {
            $groupID=$groups[$i];
                if($i>0)
                    $html.=",";
                $html.=$groupID;
        }
        $html.="];\n";
        $varName2 = $this->getName() . "groupOptions";
        $html.="var $varName2=[[]];\n";
        for($i=0;$i<count($groups);$i++) {
            $groupID=$groups[$i];
            if($groupID!=-1)
            {
                $itemCount=count($this->GroupItemsValues[$groupID]);
                if($itemCount>0)
                $html .= $varName2 . "[" . $groups[$i] . "]=[";
                for ($j = 0; $j <$itemCount ; $j++) {
                    if ($j > 0)
                        $html .= ",";
                    $html .= $this->GroupItemsValues[$groupID][$j];
                }
                if($itemCount>0)
                    $html .= "];\n";
            }
        }
        if($this->MotherComboboxName!="") {
                $theMotherCombobox="\$(\"[name=" . $this->MotherComboboxName . "]\")";
                $html .= $theMotherCombobox . ".change(function() {\n";
                $html.="\tvar gid=$theMotherCombobox" . ".val();\n";

            if($this->MotherComboboxAutoLoadMode==ComboBox::$AUTOLOADMODE_ONPAGE) {
                $html .= "\tloadSelectItems('" . $this->getName() . "',$varName2" . "[gid]);\n";
            }
            else
            {
                $html .= "\tLoadJSON2Select('" . $this->getName() . "','" . $this->DataLoadJSONURL  . $this->MotherComboboxName . "_id='+ gid);\n";
            }
//            $html .= "\talert( \"Handler for .change() called.\" );\n";
                $html .= "});";

        }
        $html.="</script>";
        return $html;
    }
	/**
	 * @param Mixed $selectedID
	 * @deprecated This Method Is Deprecated ,User SetselectedOptionInstead
	 */
	public function setSelectedID($selectedID)
	{
	    $this->setSelectedValue($selectedID);
	}
	public function setSelectedValue($SelectedValue)
	{
		$this->selectedValue = trim($SelectedValue);
	}

	public function setMultiselectable($Multiselectable)
	{
	    $this->Multiselectable = $Multiselectable;
	}
}

?>