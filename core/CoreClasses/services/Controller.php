<?php
/*
*@Author:Hadi AmirNahavandi
*@Last Update:1395/10/19
*/
namespace core\CoreClasses\services;
	use core\CoreClasses\Exception\FieldRequiredException;
    use core\CoreClasses\Exception\FieldTooLargeException;
    use core\CoreClasses\Exception\FieldTooSmallException;
    use core\CoreClasses\Exception\InvalidParameterException;

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
        protected function Validate($Field,FieldInfo $FieldInfo)
        {
            if($FieldInfo!=null)
            {
                if($FieldInfo->getRequired() && $Field=="")
                    throw new FieldRequiredException();
                if(strlen($Field)>$FieldInfo->getMaxLength())
                    throw new FieldTooLargeException();
                if(strlen($Field)>0 && strlen($Field)<$FieldInfo->getMinLength())
                    throw new FieldTooSmallException();
            }
            return true;
        }
        protected function ValidateFieldArray(array $Fields,array $FieldNames)
        {
            $cntF=count($Fields);
            $cntFI=count($FieldNames);

            if($cntF==$cntFI)
                for($i=0;$i<$cntF;$i++)
                    $this->Validate($Fields[$i],$FieldNames[$i]);
            else
                throw new InvalidParameterException("FieldCount And FieldInfoCount Are Not Equal!");
        }
    }
?>