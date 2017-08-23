<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class ComboBoxMenu extends Menu {
	private $cursor;
	private function showMenu($groups)
	{
		$dataArray=array();
		$t=0;
		for($i=0;$i<count($groups);$i++)
		{
			$dataArray[$t]['id']=$i;
			$dataArray[$t]['text']=$groups[$i]['text'];
			$t++;
			if(key_exists("subgroups", $groups[$i]) && !is_null($groups[$i]['subgroups']))
			{
				$tmpMenu=$this->showMenu($groups[$i]['subgroups']);
				
				for ($j=0;$j<count($tmpMenu);$j++)
				{
					$dataArray[$t]['id']=$tmpMenu[$j]['id'];
					$dataArray[$t]['text']="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $tmpMenu[$j]['text'];
					$t++;
				}
			}
		}
		return $dataArray;
	}
	private function showMenus()
	{
		$this->cursor=0;

		$groups=$this->getGroups();
		$class="sweetmenu";
		if(!is_null($this->getClass()))
			$class=$this->getClass();
		
		$dataArray=$this->showMenu($groups);
		$combobox=new DataComboBox($dataArray);
		return $combobox->getHTML();
	}
	public function getHTML() {

		return $this->showMenus();
	}
}

?>