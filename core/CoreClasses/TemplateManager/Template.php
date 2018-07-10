<?php

namespace core\CoreClasses\TemplateManager;

use core\CoreClasses\Forms\FormInfo;
use core\CoreClasses\services\ResponseMode;
use core\CoreClasses\Exception\ThemePageNotFound;
use core\CoreClasses\Forms\FormLoader;
/**
 *
 * @author Hadi Nahavandi
 *        
 */
class Template {
	private $TemplateName,$OutPut,$Language;
	/**
	 * @var FormInfo
	 */
	private $Form;
	/**
	 * @var FormLoader
	 */
	private $SWT_FORMLOADER;
	/**
	 * @var unknown
	 */
	private $SWT_FORM;
	function __construct($Name,$Language) 
	{
		$this->TemplateName=$Name;
		$this->Language=$Language;
	}
	public function setPage(FormInfo $Info)
	{
		$this->Form=$Info;
	}
	private function Prepare()
	{
		$lang=$this->Language;
		$module=$this->Form->getModule();
		$page=$this->Form->getPage();
		$action=$this->Form->getAction();
		define("THEMEPATH",DEFAULT_PUBLICPATH . "content/themes/" . $this->TemplateName . "/" . $lang . "/");
		define("THEMEURL",DEFAULT_PUBLICURL . "content/themes/". $this->TemplateName . "/" . $lang . "/");
		//$FormInfo=new FormInfo($module,$page,$action);
		$theForm=new FormLoader($this->Form);
		$ThemePage="index.php";
		if(isset($_GET['page']))
			if(CURRENT_RESPONSEMODE==ResponseMode::AJAX)
				$ThemePage="ajax.php";
			elseif(CURRENT_RESPONSEMODE==ResponseMode::XML)
				$ThemePage="xml.php";
			elseif(CURRENT_RESPONSEMODE==ResponseMode::JSON)
			{
				if(COMPRESSRESULT=="1")
					$ThemePage="jsonzip.php";
				else
					$ThemePage="json.php";
			}
				
			else
				$ThemePage=$theForm->getForm()->getThemePage($action);
		$themefileUrl=THEMEPATH . $ThemePage;	
		if(!file_exists($themefileUrl))
		{
		    $Ex=new  ThemePageNotFound("Theme Page $ThemePage Not Found In Path:$themefileUrl");
		    $Ex->setThemePage($ThemePage);
		    $Ex->setThemePageFileURL($themefileUrl);
		    throw $Ex;
		}
			
		$themeFileContents=file_get_contents($themefileUrl);
		$patterns = array();
		$patterns[0] = '/@@/';
		$patterns[1] = '/@#/';
		$patterns[2] = '/@page/';
		$patterns[3] = '/@>/';
		$replacements = array();
		$replacements[3] = '<?php';
		$replacements[2] = '?>';
		$replacements[1] = "<?php echo \$SWT_FORMLOADER->getResponse(); ?>";
		$replacements[0] = '<?php echo ';
		$themeFileContents=preg_replace($patterns, $replacements, $themeFileContents);
		
		$Headers="<?php";
		$Headers.="\n\$FormInfo=new core\CoreClasses\Forms\FormInfo(\"$module\",\"$page\",\"$action\");";
		$Headers.="\n\$SWT_FORMLOADER=new core\CoreClasses\Forms\FormLoader(\$FormInfo);";
		$Headers.="\n?>\n";
		//echo $Headers;
		$this->SWT_FORMLOADER=$theForm;
		$this->SWT_FORM=$theForm->getForm();
		$this->OutPut=$themeFileContents;
	}
	public function show()
	{
		$this->Prepare();
		//echo $this->OutPut;
		$SWT_FORMLOADER=$this->SWT_FORMLOADER;
		$SWT_FORM=$this->SWT_FORM;
		eval(' ?>' . $this->OutPut . '<?php ');
	}
}

?>