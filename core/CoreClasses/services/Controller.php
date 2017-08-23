<?php
/*
*@Author:Hadi AmirNahavandi
*@Last Update:1395/10/19
*/
namespace core\CoreClasses\services;
	class Controller extends ModuleClass
	{
        /**
         * Controller constructor.
         * @param $ModuleName
         */
        public function __construct($ModuleName=null)
        {
            $this->setModuleName($ModuleName);
        }
        protected function getPageCount($DataCount,$PageSize)
        {
            $pageCount=$DataCount/$PageSize;
            if($DataCount%$PageSize!=0)
                $pageCount++;
            return $pageCount;
        }

        protected function getPageRowsLimit($PageNumber,$PageSize)
        {
            $Limit=($PageNumber-1)*$PageSize . "," . $PageSize;
            return $Limit;
        }

    }
?>