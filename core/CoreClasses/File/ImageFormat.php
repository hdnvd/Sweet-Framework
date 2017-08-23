<?php

namespace core\CoreClasses\File;

/**
 *
 * @author nahavandi
 *        
 */
abstract class ImageFormat {
	private $ImageURL,$Width,$Height,$KeepAspectRatio,$AspectRatio;
	/**
	 * @var array:String
	 */
	private $FormatInfo;
	private $MimeType;
	public function __construct($ImageURL)
	{
		$this->ImageURL=$ImageURL;
		$this->FormatInfo=$this->getFormatInfo($this->getMimeType());
		$create="\\" . $this->FormatInfo['createfunction'];
		$source_image = $create($this->ImageURL);
		$this->Width=imagesx($source_image);
		$this->Height=imagesy($source_image);
		$this->AspectRatio=$this->Width/$this->Height;
		$this->KeepAspectRatio=true;
	}
	/**
	 * @param String $Mime
	 * @return array:string [createfunction,savefunction,extension]
	 */
	private function getFormatInfo($Mime)
	{
		$Mime=strtolower($Mime);
		$FormatInfo=array();
		switch ($Mime) {
			case 'image/jpeg':
				$FormatInfo['createfunction'] = 'imagecreatefromjpeg';
				$FormatInfo['savefunction'] = 'imagejpeg';
				$FormatInfo['extension'] = 'jpg';
				break;
		
			case 'image/png':
				$FormatInfo['createfunction'] = 'imagecreatefrompng';
				$FormatInfo['savefunction'] = 'imagepng';
				$FormatInfo['extension'] = 'png';
				break;
		
			case 'image/gif':
				$FormatInfo['createfunction'] = 'imagecreatefromgif';
				$FormatInfo['savefunction'] = 'imagegif';
				$FormatInfo['extension'] = 'gif';
				break;
			default:
				throw Exception('Unknown image type In ImageFormat Class.');
		}
		return $FormatInfo;
	}
	public function setWidth($Width)
	{
	    $this->Width = $Width;
	    if($this->KeepAspectRatio)
	    	$this->Height=$this->Width/$this->AspectRatio;
	}

	public function setHeight($Height)
	{
	    $this->Height = $Height;
	    if($this->KeepAspectRatio)
	    	$this->Width=$this->Height*$this->AspectRatio;
	}

	public function setKeepAspectRatio($KeepAspectRatio)
	{
	    $this->KeepAspectRatio = $KeepAspectRatio;
	}
	
	public function Save($Destination)
	{
		$save="\\" . $this->FormatInfo['savefunction'];
		$save($this->getImageObject(),$Destination);
		chmod($Destination, 0777);	
	}
	
	public function ShowImage()
	{
		header('Content-Type: ' . $this->getMimeType());
		$show="\\" . $this->FormatInfo['savefunction'];
		$save($this->getImageObject());
		
	}
	
	private function getImageObject()
	{
		$create="\\" . $this->FormatInfo['createfunction'];
		$MainImage=$create($this->ImageURL);
		$TempImage = \imagecreatetruecolor($this->Width, $this->Height);
		
		imagealphablending($TempImage, false);
		imagesavealpha($TempImage,true);
		$transparent = imagecolorallocatealpha($TempImage, 255, 255, 255, 127);
		imagefilledrectangle($TempImage, 0, 0, $this->Width, $this->Height, $transparent);
		\imagecopyresampled($TempImage,$MainImage,0,0,0,0,$this->Width,$this->Height,imagesx($MainImage),imagesy($MainImage));
		
		
		return $TempImage;
	}

	protected abstract function getMimeType();
}

?>