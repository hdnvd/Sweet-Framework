<?php

namespace core\CoreClasses\html;

/**
 *
 * @author nahavandi
 *        
 */
class Menu extends baseHTMLElement {
	private $groups;
	private $TextField,$LinkField;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\html\baseHTMLElement::getHTML()
	 *
	 */
	public function __construct()
	{
		$this->TextField="text";
		$this->LinkField="link";
	}
	public function getHTML() {
		return $this->showMenus();
	}
	private function showMenu($groups)
	{

		
		$ul=new UList();
		$ul->setClass($this->getClass());
		for($i=0;$i<count($groups);$i++)
		{
			$content=new link($groups[$i][$this->LinkField], $groups[$i][$this->TextField]);
			$liclass="last";
			if(key_exists("subgroups", $groups[$i]) && !is_null($groups[$i]['subgroups']))
			{
				$content.="\n" . $this->showMenu($groups[$i]['subgroups']);
				$liclass="has-sub";
			}
			$li=new UListElement($content);
	
			$li->setClass($liclass);
			$ul->addElement($li);
			
		}
		return $ul->getHTML();
	}
	private function showMenus()
	{
		$groups=$this->groups;
		$class="sweetmenu";
		if(!is_null($this->getClass()))
			$class=$this->getClass();
		$div=new Div();
		$div->setClass($class);
		$div->setStyle($this->getStyle());
		$div->setId($this->getId());
		$ul=new UList();
		$ul->setId($this->getId() . "list");
		$ul->setClass($class . "list");
		for($i=0;$i<count($groups);$i++)
		{
			$content=new link($groups[$i][$this->LinkField], $groups[$i][$this->TextField]);
			$content->setOnClick("return false");
			$liclass="last";
			if(key_exists("subgroups", $groups[$i]) && $groups[$i]['subgroups']!==null)
			{
				$content.="\n" . $this->showMenu($groups[$i]['subgroups']);
				$liclass="has-sub";
			}
			$li=new UListElement($content);
			$li->setClass($liclass);
			$ul->addElement($li);
		}
		$div->addElement($ul);
		return $div->getHTML();
	}

	public function getGroups()
	{
	    return $this->groups;
	}

	public function setGroups($groups)
	{
	    $this->groups = $groups;
	}

	public function setTextField($TextField)
	{
	    $this->TextField = $TextField;
	}

	public function setLinkField($LinkField)
	{
	    $this->LinkField = $LinkField;
	}
}

?>