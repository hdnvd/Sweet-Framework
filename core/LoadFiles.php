<?php

$path=array();
function getsubdirectories($Root,$class)
{
    global $path;
    $ffs = scandir($Root);
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..')
            if(is_dir($Root.'/'.$ff))
            {
                array_push($path,$Root.'/'.$ff . "/" . $class .".php");
                array_push($path,$Root.'/'.$ff . "/" . $class .".class.php");
                array_push($path,$Root.'/'.$ff . "/" ."class." .  $class .".php");
                	
                array_push($path,$Root.'/'.$ff . "/" . strtolower($class) .".php");
                array_push($path,$Root.'/'.$ff . "/" . strtolower($class) .".class.php");
                array_push($path,$Root.'/'.$ff . "/" ."class." .  strtolower($class) .".php");
                	
                getsubdirectories($Root.'/'.$ff,$class);
            }

    }
}


spl_autoload_register(function ($class)
{
    global $path;
    $parts = explode('\\', $class);
    $class= end($parts);

    $smartpath=DEFAULT_APPPATH;
    for($i=0;$i<count($parts)-1;$i++)
        $smartpath .= $parts[$i] . "/";
        $coresmartpath=DEFAULT_FRAMEWORKPATH;
        for($i=0;$i<count($parts)-1;$i++)
            $coresmartpath .= $parts[$i] . "/";
            getsubdirectories(DEFAULT_FRAMEWORKPATH . "classes/",$class);
		$path[0]=DEFAULT_FRAMEWORKPATH . "core/" . $class . ".php";
		$path[1]=DEFAULT_FRAMEWORKPATH . "classes/" . $class . ".php";
		$path[2]=DEFAULT_FRAMEWORKPATH . "core/CoreClasses/" . $class . ".php";
		$path[3]=DEFAULT_FRAMEWORKPATH . "core/CoreClasses/db/" . $class . ".php";
		$path[4]=DEFAULT_FRAMEWORKPATH . "core/CoreClasses/services/" . $class . ".php";
		$path[5]=$smartpath . "classes/" . $class . ".class.php";
		$path[6]=$smartpath . $class . ".code.php";
		$path[7]=$smartpath . $class . ".design.php";
		$path[8]=$smartpath . $class . ".class.php";
		$path[9]=$coresmartpath . $class . ".php";
		getsubdirectories(DEFAULT_FRAMEWORKPATH . "classes",$class);

		$found=false;
		$foundpath=null;
		for($i=0;$i<count($path) && $found==false;$i++)
		{
		$foundpath=$path[$i];
		if(DEBUGMODE==true)
		  echo "findings $foundpath <br>\n";
		if(file_exists($foundpath))
		    $found=true;
		}
		if($found)
		{
		if(DEBUGMODE==true)
		    echo "--found $foundpath <br>\n";
		    if(OBFUSCATE==true)
		    {
		    $file=fopen($foundpath,"r");
		    $text=fread($file,filesize($foundpath));
		    $text=base64_decode($text);
		    $pos=strpos($text, "<?php");
		    $text=substr($text, $pos+5);
		        eval($text);
		    }
		    else
		    {
		    require_once ($foundpath);
		    }
}
if(!$found)
		{
 			if(DEBUGMODE)
 			    die("Class Not Found!!");
 			    else
 			die("Class $class Not Found!!");
			//throw new core\CoreClasses\Exception\ClassNotFoundException("Class $class Not Found!");
		}
	});

	use core\classes;
	?>