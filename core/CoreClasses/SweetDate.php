<?php
namespace core\CoreClasses;
class SweetDate extends \jDateTime {
    public static function getTimeFromDateText($Date,$Hour,$Minute,$Delimiter)
    {

        date_default_timezone_set("Asia/Tehran");
        $sweetDate = new SweetDate(true, true, 'Asia/Tehran');
        $Date = trim($Date);
        $day = null;
        $year = null;
        $month = null;
        if (substr($Date, 4, 1) == $Delimiter && substr($Date, 7, 1) == $Delimiter) {
            $year = substr($Date, 0, 4);
            $month = substr($Date, 5, 2);
            $day = substr($Date, 8, 2);
        }
        if ($day==null)
            $time=0;
        else
            $time = $sweetDate->mktime($Hour, $Minute, "0", $month, $day, $year);
        return $time;
    }
}

?>