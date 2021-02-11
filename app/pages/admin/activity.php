<?php
    include "../app/includes/functions/admin.php";
    include "../app/includes/queries/admin.php";

    if(!loggedIn()) headerLocation('home');

    $today = strtotime('now');
    $get_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d', $today);
    
    $dates = [$get_date];
    $actions = actionsOnDates($dates, 10000);
?>

<link rel='stylesheet' href='styles/admin.css'>
<div class='subpage activity-page d-flex flex-column p-4'>
    <h1 class='text-center'>Activity History</h1>

    <div class='row d-flex flex-column-reverse flex-lg-row mt-2 mx-0 mx-xl-5'>
        <div class='recent col col-lg-4'>
        <?php
            for($i = count($dates)-1; $i >= 0; $i--){
                echo "<ul class='list-group mt-3 mb-4'>";
                echo "<h4 class='mb-3'><b><u>{$dates[$i]}</u></b> (<span class='actions-amount'></span> actions)</h4>";

                foreach($actions[$i] as $item){
                    $item['updated_at'] = strtotime($item['updated_at']);
                    $item['created_at'] = strtotime($item['created_at']);

                    if(strpos(date("Y-m-d", $item['updated_at']), $dates[$i]) !== false){
                        echo "<li class='list-group-item list-group-item-warning'>Updated <i>{$item['brand']} (<a href='collection?field=id&search={$item['id']}'>#{$item['id']}</a>)</i></li>";
                    }
                    
                    if(strpos(date("Y-m-d", $item['created_at']), $dates[$i]) !== false){              
                        echo "<li class='list-group-item list-group-item-success'>Added <i>{$item['brand']} (<a href='collection?field=id&search={$item['id']}'>#{$item['id']}</a>)</i></li>";
                    }
                }

                echo "</ul>";
            }
        ?>
        </div>
        
        <div class='col-3'></div>

        <?php include "calendar.php"; ?>
    </div>
</div>

<script src='scripts/min/actions_amount.min.js'></script>