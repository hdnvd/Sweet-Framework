<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/06
*/
namespace core\CoreClasses\services;
	use core\CoreClasses\db\dbaccess;
    use core\CoreClasses\db\DBField;
    use core\CoreClasses\db\DBValue;
    use core\CoreClasses\db\FieldCondition;
    use core\CoreClasses\db\LogicalOperator;
    use core\CoreClasses\db\QueryLogic;
    use core\loader;
    use Modules\sfman\Entity\sfman_pageinfoEntity;

    /*
    * @Author:Hadi AmirNahavandi
    * @Creation Date:1393/02/13
    * @Last Update:1396/07/06
    * @Description:Parent Of All FormCodes
    */
	abstract class FormCode extends ModuleClass
	{
		private $loadType,$ThemePage,$Title;
		private $Keywords,$Description,$CanonicalURL;
        private $CustomPageInfo=null;
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
		    $this->CustomPageInfo=$this->getCustomPageInfo();
		    $this->setThemePage("page.php");
            $this->Keywords="";
            $this->Title=null;
            $this->CanonicalURL=null;
            $this->Description=null;
            $this->setModuleName($namespace);
		}

        /**
         * @return EntityClass|sfman_pageinfoEntity
         */
        private function getCustomPageInfo()
        {
            $dbAccessor=new dbaccess();
            $URL=$_SERVER['REQUEST_URI'];
            $Ent=new sfman_pageinfoEntity($dbAccessor);
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(sfman_pageinfoEntity::$INTERNALURL, $URL,LogicalOperator::Equal));
            $Ent=$Ent->FindOne($q);
            if($Ent==null)
            {
                $Ent=new sfman_pageinfoEntity($dbAccessor);
                $q=new QueryLogic();
                $q->addCondition(new FieldCondition("LENGTH(".sfman_pageinfoEntity::$SENTENCEINURL.")","4",LogicalOperator::Bigger));
                $q->addCondition(new FieldCondition(new DBValue( $URL ),new DBField("CONCAT('%', " . sfman_pageinfoEntity::$SENTENCEINURL . ", '%')",false),LogicalOperator::LIKE));
                $q->addOrderBy("LENGTH(".sfman_pageinfoEntity::$SENTENCEINURL.")",true);
                $Ent=$Ent->FindOne($q);
            }
            $dbAccessor->close_connection();
            return $Ent;
        }
		public function getThemePage($Action="load")
		{
		    if($this->CustomPageInfo==null)
		        return $this->ThemePage;
		    else
		        return $this->CustomPageInfo->getThemepage();
		}

		protected function setThemePage($ThemePage)
		{
		    $this->ThemePage = $ThemePage;
		}

		public function getTitle()
		{
            if($this->CustomPageInfo==null)
                return $this->Title;
            else
                return $this->CustomPageInfo->getTitle();

		}

		protected function setTitle($Title)
		{
		    $this->Title = $Title;
		}

		public function getKeywords()
		{
            if($this->CustomPageInfo==null)
                return $this->Keywords;
            else
                return $this->CustomPageInfo->getKeywords();
		}
/*
		public function addKeyword($Keyword)
		{
		    array_push($this->Keywords, $Keyword);
		}
*/
		public function getDescription()
		{

            if($this->CustomPageInfo==null)
                return $this->Description;
            else
                return $this->CustomPageInfo->getDescription();

		}

		public function setDescription($Description)
		{
		    $this->Description = $Description;
		}

		public function getCanonicalURL()
		{

            if($this->CustomPageInfo==null)
                return $this->CanonicalURL;
            else
                return $this->CustomPageInfo->getCanonicalurl();
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