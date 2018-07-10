<?php
namespace core;
class deviceinterface
{
  const  WEBBROWSER=1;
  const  Android=2;
  private $DeviceType;
  /*
    $DeviceType=1 //Web Browser
    $DeviceType=2 //Android Mobile
  */
  public function setDeviceType($deviceType)
  {
    $this->DeviceType=$deviceType;
  }
  public function getDeviceLink($link,$innerHTML,$linkScope=1,$class="",$id="")
  {
    $fullLink="";
    if($id!="")
      $idText=" id=\"$id\" ";
    else
      $idText="";
    if($class!="")
      $classText=" class=\"$class\" ";
    else
      $classText="";
      
      
    if($linkScope==1)//Internet
    {
      if($this->DeviceType==1)
      {
	$fullLink="<a href=\"$link\"$idText $classText>$innerHTML</a>"; 
      }
      else if($this->DeviceType==2)
      {
	$fullLink="<a href=\"#\" onclick=\"load('$link')\" $idText $classText>$innerHTML</a>"; 
      }
    }
    else if($linkScope==3)//This Site
    {
      if($this->DeviceType==1)
      {
	$fullLink="<a href=\"$link\"$idText $classText>$innerHTML</a>"; 
      }
      else if($this>DeviceType==2)
      {
	$fullLink="<a href=\"#\" onclick=\"loadthissite('$link')\" $idText $classText>$innerHTML</a>"; 
      }
    }
    return $fullLink;
    
  }
  /*
    $linkScope=1 Internet
    $linkScope=2 This Domain
    $linkScope=3 This Site
    $linkScope=4 This Folder
  */
}
?>