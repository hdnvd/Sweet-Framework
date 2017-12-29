<?php

namespace core\CoreClasses\html;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\services\FieldType;
use core\CoreClasses\SweetDate;

/**
 *
 * @author nahavandi
 *        
 */
class TimePicker extends TextBox
{

    public function __construct($Name, $Text = null, $Visible = true, $ID = null, $Class = "timepicker", $ReadOnly = true)
    {
        parent::__construct($Name, $Text, $Visible, $ID, $Class, $ReadOnly);
    }

    public function getHTML()
    {
        $HTML = parent::getHTML();
        $HTML .= "<script language='javascript'>addToTimePickers('" . $this->getId() . "')</script>";
        return $HTML;
    }

    public function getAllMinutes()
    {
        return TimePicker::getMinutesFromText($this->getValue());
    }

    public function setTime($time)
    {

        date_default_timezone_set("Asia/Tehran");
        $sweetDate = new SweetDate(false, true, 'Asia/Tehran');
        $dt = $sweetDate->date("H:i", $time);
//        echo "<p>Date:" . $dt . "</p>";
        $this->setValue($dt);
    }

    public static function getMinutesFromText($Date)
    {
        $Date = trim($Date);
        $Date=str_replace(" ","",$Date);
//        echo $Date;
        $hour=substr($Date,0,2);
//        echo $hour;
        $minute=substr($Date,3,2);
//        echo $minute;
        $time=$hour*60+$minute;
        return $time;
    }
//    public static function getTimeFromText($Date,$Time)
//    {
//        $sweetDate = new SweetDate();
//        $Date = trim($Date);
//        $hour=substr($Date,0,2);
//        $minute=substr($Date,2,2);
//        $time=$hour*60+$minute;
//        return $time;
//    }
}

?>