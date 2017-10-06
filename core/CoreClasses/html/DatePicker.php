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
class DatePicker extends TextBox
{

    public function __construct($Name, $Text = null, $Visible = true, $ID = null, $Class = "datepicker", $ReadOnly = true)
    {
        parent::__construct($Name, $Text, $Visible, $ID, $Class, $ReadOnly);
    }

    public function getHTML()
    {
        $HTML = parent::getHTML();
        $HTML .= "<script language='javascript'>addToDatePickers('" . $this->getId() . "')</script>";
        return $HTML;
    }

    public function getTime()
    {
        return DatePicker::getTimeFromText($this->getValue());
    }

    public function setTime($time)
    {
        $sweetDate = new SweetDate(false, true);
        $dt = $sweetDate->date("Y/m/d", $time);
        $this->setValue($dt);
    }

    public static function getTimeFromText($Date)
    {
        $sweetDate = new SweetDate();
        $Date = trim($Date);
        $day = null;
        $year = null;
        $month = null;
        if (substr($Date, 4, 1) == "/" && substr($Date, 7, 1) == "/") {
            $year = substr($Date, 0, 4);
            $month = substr($Date, 5, 2);
            $day = substr($Date, 8, 2);
        }
        if ($day==null)
            $time=0;
        else
            $time = $sweetDate->mktime("11", "48", "0", $month, $day, $year);
        return $time;
    }
}

?>