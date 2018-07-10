<?php
namespace core\CoreClasses\services;
/**
 * Created by PhpStorm.
 * User: Hadi
 * Date: 1/8/2017
 * Time: 2:56 PM
 */
class ModuleClass
{
    private $ModuleName;

    /**
     * @return string
     */
    protected function getModuleName()
    {
        return $this->ModuleName;
    }

    /**
     * @param string $ModuleName
     */
    public function setModuleName($ModuleName)
    {
        if($ModuleName!=null){
            $this->ModuleName = $ModuleName;

        }
    }

    public function getModuleDirectory()
    {
        return DEFAULT_APPPATH . "Modules/" . $this->getModuleName() . "/";
    }

    public function getTextsDirectory()
    {
        return $this->getModuleDirectory() . "Files/Text/";
    }
    public function getJsFilesDirectory()
    {
        return $this->getModuleDirectory() . "Files/JS/";
    }
    public function getPHPFilesDirectory()
    {
        return $this->getModuleDirectory() . "Files/PHP/";
    }

}
?>