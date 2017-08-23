<?php
class filemanager
{
	public function uploadFile($filename,$fieldname)
	{
		global $DEFAULT;
		$uploadPlace=$DEFAULT['apppath'] . "content/files/";
		$uploadPlace .=$filename;
		//echo $_FILES[$fieldname]['name'];
    	if(file_exists($uploadPlace))
	    	return 2;//file exists
		else if(move_uploaded_file($_FILES[$fieldname]['tmp_name'],$uploadPlace))
        	return  "content/files/" . $filename;//upload successful
    	else
        	return 1;//error uploading
	}
}
