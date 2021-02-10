<?php
    $date = new DateTime($get_date);

    $month = $date->format("F");
    $month_nr = $date->format("m");
    $year = $date->format("Y");

    $first = $date->modify('first day of this month')->format("N");
    $last = $date->modify('last day of this month')->format("j");

    $prev_month = $date->modify('first day of -1 month')->format("m");
    $prev_month = $date->format('Y') . "-" . $prev_month;
    $next_month = $date->modify('first day of +2 month')->format("m");
    $next_month = $date->format('Y') . "-" . $next_month;

    $last_prev = $date->modify('last day of last month')->format("j");

    $actions = getActionsOnDate("$year-$month_nr", 1000);
    $created = false;
    $updated = false;
    foreach($actions as $action){
        if(strpos($action['created_at'], "$year-$month_nr") !== false) $created = true;
        if(strpos($action['updated_at'], "$year-$month_nr") !== false) $updated = true;

        if($created && $updated) break;
    }
?>
<div class='calendar col m-0 p-0'>
    <table class='table table-bordered text-center'>
        <thead>
            <tr>
                <th colspan="2" class='m-0 p-0 arrow'><a href='admin/activity?date=<?=$prev_month?>' style='text-decoration: none;'>&larr;</a></th>
                <th colspan="3"><a href='admin/activity?date=<?="$year-$month_nr"?>'><?="$month $year"?></a></th>
                <th colspan="2" class='m-0 p-0 arrow'><a href='admin/activity?date=<?=$next_month?>' style='text-decoration: none;'>&rarr;</a></th>
            </tr>

            <tr>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th>
            </tr>
        </thead>

        <tbody>
            <tr>
            <?php
            // always show 6 weeks
            $days_shown = 42;

            // loop for days before month start
            $day_bef = $first == 1 ? $last_prev-7+1 : $last_prev-$first+2;
            for($day = $day_bef; $day <= $last_prev; $day++){
                echo "<td class='text-muted'>$day</td>";
            }

            for($day = 1; $day <= $last; $day++){
                if(($day + $first - 2) % 7 == 0) echo "</tr><tr>";

                $color = $month == date("F", $today) && $day == date("j", $today) ? "font-weight-bold" : "text-primary";
                $day_nr = $day < 10 ? "0$day" : $day;
                $active = "$year-$month_nr-$day_nr" == $get_date ? "active" : "";

                $added = "";
                $edited = "";
                if($created || $updated){
                    foreach($actions as $action){
                        if(strpos($action['created_at'], "$year-$month_nr-$day_nr") !== false) $added = "<span class='badge badge-pill badge-success' style='font-size: 40%;'>&nbsp;</span>";
                        if(strpos($action['updated_at'], "$year-$month_nr-$day_nr") !== false) $edited = "<span class='badge badge-pill badge-warning' style='font-size: 40%;'>&nbsp;</span>";
                    }
                }

                $badges = !empty($added) || !empty($edited) ? "<br>" : "";
                $badges .= $added;
                $badges .= !empty($edited) ? " $edited" : $edited; 

                echo "<td class='month-cell align-middle $color $active'><a href='admin/activity?date=$year-$month_nr-$day_nr' style='text-decoration: none;'>$day$badges</a></td>";
            }

            // loop for days after month end
            $day_af = $days_shown - ($last_prev - $day_bef) - $last - 1;
            for($day = 1; $day <= $day_af; $day++){
                if(($day + $first + $last - 2) % 7 == 0) echo "</tr><tr>";
                
                echo "<td class='text-muted'>$day</td>";
            }
            ?>
            </tr>
        </tbody>
    </table>
</div>

<script>
    $(".month-cell, .arrow").click(function(){
        $(this).children().first()[0].click();
    });
</script>