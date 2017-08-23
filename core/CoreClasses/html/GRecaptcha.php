<?php

namespace core\CoreClasses\html;
use core\CoreClasses\Net\WebClient;

/**
 *
 * @author nahavandi
 *
 */
class GRecaptcha extends Div{
    public function __construct()
    {
        $this->setClass("g-recaptcha");
        $key=$this->getRecaptchaSiteKey();
        $this->SetAttribute("data-sitekey",$key);
    }
    private function getRecaptchaSiteKey()
    {
        $key=0;
        if(defined('DEFAULT_GRECAPTCHA_SITE_KEY'))
            $key=DEFAULT_GRECAPTCHA_SITE_KEY;
        else
            throw new \Exception("Recaptcha Site Key Not Set in Settings");
        return $key;
    }
    private function getRecaptchaSecretKey()
    {
        $key=0;
        if(defined('DEFAULT_GRECAPTCHA_SECRET_KEY'))
            $key=DEFAULT_GRECAPTCHA_SECRET_KEY;
        else
            throw new \Exception("Recaptcha Secret Key Not Set in Settings");
        return $key;
    }
    public function setClass($class)
    {
        parent::setClass("g-recaptcha");
    }
    public function getValidationStatus()
    {
        // echo "Validating";
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
            $secret=$this->getRecaptchaSecretKey();
            $cli=new WebClient();
            $verifyResponse = $cli->DownloadString('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            // echo "Str:".$verifyResponse;
            $responseData = json_decode($verifyResponse);
            if($responseData->success):
                return GRecaptchaValidationStatus::$VALID;
            else:
                return GRecaptchaValidationStatus::$NOTVALID;
            endif;
        else:
            return GRecaptchaValidationStatus::$NOTCLICKED;
        endif;
    }

}
class GRecaptchaValidationStatus
{
    public static $VALID=1;
    public static $NOTVALID=2;
    public static $NOTCLICKED=3;
}

?>