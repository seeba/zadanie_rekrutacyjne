<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class PESELHelper
{
    public static function getDateOfBirth($pesel)
    {
        $month = substr($pesel, 2, 2);
        $day = substr($pesel, 4, 2);

        $baseMonths = range(1,12);
        $additionalMonths = [80,0,20,40,60];

        foreach ($additionalMonths as $additionalMonth) {
            foreach ($baseMonths as $baseMonth) {
                $months[] = $additionalMonth+$baseMonth;
            }
        }

        if (substr($month,0,1)=='0' || substr($month,0,1)=='1') $century = 1900;
        if (substr($month,0,1)=='8' || substr($month,0,1)=='9') $century = 1800;
        if (substr($month,0,1)=='2' || substr($month,0,1)=='3') $century = 2000;
        if (substr($month,0,1)=='5' || substr($month,0,1)=='4') $century = 2100;
        if (substr($month,0,1)=='6' || substr($month,0,1)=='7') $century = 2200;
        if ($century==2000) $month = $month-20;
        if ($century==1800) $month = $month-80;
        if ($century==2100) $month = $month-40;
        if ($century==2200) $month = $month-60;

        $year = $century+substr($pesel, 0,2);
        $date = new Carbon($year.'-'.$month.'-'.$day);
        return [
            'year' => $year, 
            'month' => $month,
            'day' => $day,
            'date' => $date,
            'age' => $date->age 
        ];
    }

    public function getAge($pesel)
    {

    }
}