<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/06
*/
namespace core\CoreClasses\services;
	use core\loader;
	/*
	* @Author:Hadi AmirNahavandi
	* @Creation Date:1393/02/13
	* @Last Update:1395/10/19
	* @Description:Parent Of All FormCodes
	*/
	abstract class FormCode extends ModuleClass
	{
		private $loadType,$ThemePage,$Title;
		private $Keywords,$Description,$CanonicalURL;

		public function setLoadType($type)
		{
			if($type=="ajax")
				$this->loadType="ajax";
			else if($type=="normal")
				$this->loadType="normal";
		}
		public function getLoadType()
		{
			return $this->loadType;
		}

        public function getHttpGETparameter($Name,$DefaultValue)
        {
            $p=$DefaultValue;
            if(isset($_GET[$Name]))
                $p=$_GET[$Name];
            return $p;
        }

        public function load(){}
		
		
		
		public function __construct($namespace)
		{
			$this->setThemePage("page.php");
			$this->Keywords=array();
			$this->Title=null;
			$this->CanonicalURL=null;
			$this->Description=null;
            $this->setModuleName($namespace);
		}

	
		public function getThemePage($Action="load")
		{
		    return $this->ThemePage;
		}

		protected function setThemePage($ThemePage)
		{
		    $this->ThemePage = $ThemePage;
		}

		public function getTitle()
		{
		    return $this->Title;
		}

		protected function setTitle($Title)
		{
		    $this->Title = $Title;
		}

		public function getKeywords()
		{
		    return $this->Keywords;
		}

		public function addKeyword($Keyword)
		{
		    array_push($this->Keywords, $Keyword);
		}

		public function getDescription()
		{
		    return $this->Description;
		}

		public function setDescription($Description)
		{
		    $this->Description = $Description;
		}

		public function getCanonicalURL()
		{
		    return $this->CanonicalURL;
		}

		public function setCanonicalURL($CanonicalURL)
		{
		    $this->CanonicalURL = $CanonicalURL;
		}

	public function setKeywords($Keywords)
	{
	    $this->Keywords = $Keywords;
	}
}
?>