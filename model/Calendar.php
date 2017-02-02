<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Calendar {

    function __Construct() {
        
    }

    static function getCalendar() {
        $mydate = getdate();
        $num_of_days = cal_days_in_month(CAL_GREGORIAN, $mydate['mon'], $mydate['year']);
        $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $calendarTable = "<table>";
        $colNames = "<tr>";
        $day = 0;
        for ($i = 0; $i < sizeof($days); $i++) {
            if ($days[$i] == substr($mydate['weekday'], 0, 3)) {
                $day = $i;
                break;
            }
        }
        for ($i = $day; $i < sizeof($days); $i++) {
            $colNames.='<th>' . $days[$i] . '</th>';
        }
        for ($i = 0; $i <= 7-$day; $i++) {
            $colNames.='<th>' . $days[$i] . '</th>';
        }
        $colNames.="</tr>";
        $calendarRows = '';

        for ($i = $mydate['mday']; $i <= $num_of_days + 7; $i+=7) {
            $c = 0;
            $calendarRows.="<tr>";
            for ($j = $i; $j <= ($i * 7) && $j <= $num_of_days; $j++) {
                $calendarRows.="<td id='".$j."'>$j</td>";
                if ($c == 6) {
                    break;
                } else {
                    $c++;
                }
            }
            $calendarRows.="</tr>";
        }
        $calendarTable.=$colNames;
        $calendarTable.=$calendarRows;
        $calendarTable.="</table>";
        return $calendarTable;
    }

}
