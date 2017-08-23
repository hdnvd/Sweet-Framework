<?php
namespace core\CoreClasses\File;

class SweetZipArchive extends \ZipArchive {
    private $ExcludedDirNames;
    private $ExcludedFileNames;
    private $ExcludedPaths;
    // Member function to add a whole file system subtree to the archive
    public function addTree($dirname, $localname = '') {
        if ($localname)
            $this->addEmptyDir($localname);
        $this->_addTree($dirname, $localname);
    }
    
    // Internal function, to recurse
    protected function _addTree($dirname, $localname) 
    {
        //Ensures that directory has no "/" sign at the end
        $PathLength=strlen($dirname);
        if(substr($dirname, $PathLength-1,1)=="/")
            $dirname=substr($dirname, 0,$PathLength-1);
        
//         echo $dirname . "\n";
        
        $dir = opendir($dirname);
        while ($filename = readdir($dir)) 
        {
            // Discard . and ..
            if ($filename == '.' || $filename == '..')
                continue;

            // Proceed according to type
            
            $path = $dirname . '/' . $filename;
            $localpath = $localname ? ($localname . '/' . $filename) : $filename;
            if(!is_array($this->ExcludedPaths) || !in_array($path, $this->ExcludedPaths))
            {
                if (is_dir($path)) {
                    // Directory: add & recurse
                    if(!is_array($this->ExcludedDirNames) || !in_array($dirname, $this->ExcludedDirNames))
                    {
                        $this->addEmptyDir($localpath);
                        $this->_addTree($path, $localpath);
                    }
                }
                else if (is_file($path)) 
                {
                    // File: just add
                    if(!is_array($this->ExcludedFileNames) || !in_array($dirname, $this->ExcludedFileNames))
                    {
                        $this->addFile($path, $localpath);
                    }
                }
            }
         }
         closedir($dir);
        
    }

    // Helper function
    public static function zipTree($dirname, $zipFilename, $flags = 0, $localname = '') {
        $zip = new self();
        $zip->open($zipFilename, $flags);
        $zip->addTree($dirname, $localname);
        $zip->close();
    }
    
    
    public function AddExcludedPath($Path)
    {
        //Ensures that directory has no "/" sign at the end
        $PathLength=strlen($Path);
        if(substr($Path, $PathLength-1,1)=="/")
            $Path=substr($Path, 0,$PathLength-1);
        
        if(!is_array($this->ExcludedPaths))
            $this->ExcludedPaths=array();
        array_push($this->ExcludedPaths, $Path);
    }
    public function AddExcludedDirName($DirName)
    {
        if(!is_array($this->ExcludedDirNames))
            $this->ExcludedDirNames=array();
        array_push($this->ExcludedDirNames, $DirName);
    }
    public function AddExcludedFileName($FileName)
    {
        if(!is_array($this->ExcludedFileNames))
            $this->ExcludedFileNames=array();
        array_push($this->ExcludedFileNames, $FileName);
    }
}
?>