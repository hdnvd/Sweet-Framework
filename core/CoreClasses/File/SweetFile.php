<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 5/27/2017
 * Time: 7:30 PM
 */

namespace core\CoreClasses\File;


class SweetFile
{
    public static function setPermission($File,$Permission)
    {
        chmod($File, $Permission);
    }
}
?>