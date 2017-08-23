<?php
namespace core\CoreClasses\File;
use core\CoreClasses\Exception\DirectoryNotExistsError;
use core\CoreClasses\Exception\FileExistsError;
use core\CoreClasses\Exception\FileSizeError;
use core\CoreClasses\Exception\FileTypeError;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class Uploader {
	private $permission;
	public function __construct()
	{
		$this->permission=0777;
	}
	public function uploadFile($tmpFile,$newAddress,$Override=false,array $fileTypes=null,$maxSize=2000,$fileType=null)
	{

        if(!is_null($fileTypes))
        {
            $extensionMatched=false;
            for($i=0;$i<count($fileTypes);$i++)
                if(strtolower($fileType)==strtolower($fileTypes[$i]))
                    $extensionMatched=true;
            if(!$extensionMatched)
                throw new FileTypeError();
        }
        if(filesize($tmpFile)>($maxSize*1024))
            throw new FileSizeError();

        $pinf=pathinfo($newAddress);
        if(!file_exists($pinf['dirname']))
            throw new DirectoryNotExistsError();
    	if(file_exists($newAddress) && $Override==false)
        {
            throw  new FileExistsError();
//            return 2;//file exists

        }
		else if(move_uploaded_file($tmpFile,$newAddress))
		{
		    SweetFile::setPermission($newAddress, $this->permission);
        	return  $newAddress;//upload successful
		}
    	else
            return new SweetException();
//        	return 1;//error uploading
	}

	public function getPermission()
	{
	    return $this->permission;
	}

	public function setPermission($permission)
	{
	    $this->permission = $permission;
	}
}

?>