<?php

class Calendar extends Dbcon{


    function build_calendar($month, $year){
        setlocale(LC_TIME, "fr_FR");

        $sql = "SELECT * FROM visite, prospect WHERE MONTH(visite.date_de_visite) = '$month' and YEAR(visite.date_de_visite) =  '$year' and prospect.prospect_id = visite.prospect_id ORDER BY visite.date_de_visite";
        $result = $this->read($sql);

        $daysOfWeek = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

        $firstDayOfMonth = mktime(0,0,0, $month, 1, $year);

        $numberDays = date('t', $firstDayOfMonth);

        $dateComponents = getdate($firstDayOfMonth);

        $monthName = strftime("%B", strtotime($dateComponents['month']));


        $dayOfWeek = $dateComponents['wday'];
        if($dayOfWeek == 0){
            $dayOfWeek = 6;
        }else{
            $dayOfWeek = $dayOfWeek-1;
        }

        $dateToday = date('Y-m-d');
        $calendar = "<div class='table-responsive'>";
        $calendar .= "<table class='table table-bordered' id='calendar'>";
        $calendar.= "<div class='d-flex p-2 justify-content-around'>";
        $calendar.= "<a class='btn btn-primary text-center align-self-center btn-sm' href='?page=tableau&month=".strftime('%m', mktime(0,0,0, $month-1, 1, $year))."&year=".strftime('%Y', mktime(0,0,0, $month-1, 1, $year))."'>Mois Precedente</a>";
        $calendar.= "<h2 class='text-center'>$monthName $year</h2>";
        $calendar.= "<a href='?page=tableau&month=".strftime('%m', mktime(0,0,0, $month+1, 1, $year))."&year=".strftime('%Y', mktime(0,0,0, $month+1, 1, $year))."' class='btn btn-primary text-center align-self-center btn-sm'>Mois Prochaine</a>";

        $calendar.= "</div>";
        $calendar.= "<tr>";

        foreach ($daysOfWeek as $day){
            $calendar.= "<th class='header thead-light text-center'>$day</th>";
        }

        $calendar.= "</tr><tr>";

        if($dayOfWeek > 0){
            for($i = 0; $i < $dayOfWeek; $i++){
                $calendar.= "<td></td>";
            }
        }

        $currentDay = 1;

        $month = str_pad($month, 2, "0", STR_PAD_LEFT);

        while($currentDay <= $numberDays){
            if($dayOfWeek == 7){
                $dayOfWeek = 0;
                $calendar.= "</tr><tr>";
            }

            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";

            if($dateToday == $date){
               $calendar.= "<td class='today'><h5 class='float-right'>$currentDay</h5>";
            }else{
               $calendar.= "<td><h5 class='float-right'>$currentDay</h5>";
            }
            if($result){
                foreach ($result as $key => $row){
                    if($row["date_de_visite"] == $date){
                        $calendar.= "<button class='btn btn-success' data-toggle='collapse' data-target='#res".$row["visite_id"]."'> &bull;</button>";
                    }
                }
            }

            $calendar.= "</td>";

            $currentDay++;
            $dayOfWeek++;
        }

        if($dayOfWeek != 7){
            $remainingDays = 7-$dayOfWeek;
            for($i = 0; $i < $remainingDays; $i++){
                $calendar.= "<td></td>";
            }
        }

        $calendar.= "</tr>";

        $calendar.= "</table>";
        $calendar.= "</div>";

        foreach ($result as $key => $row){
            $calendar.= "<div id='res".$row['visite_id']."' class='collapse mt-2'> Date de visite: ".strftime("%d %B %Y", strtotime($row['date_de_visite']))."<br>Prospect: ".$row["nom"] . " " . $row["prenoms"]."<br>T&eacute;l&eacute;phone: ".$row['telephone']."<br>Objet de Visite: ".$row['objet_visite']."</div>";
        }
        echo $calendar;

    }


}

?>