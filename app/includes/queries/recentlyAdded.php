<?php

function getRecentlyAdded($amount = 9)
{
    global $conn;

    $query = "SELECT * FROM `collection` ORDER BY `id` DESC LIMIT $amount;";
    $result = mysqli_query($conn, $query);

    $items = [];
    while($row = mysqli_fetch_array($result))
    {
        $row['created_date'] = getDateFromDatetime($row['created_at']);
        array_push($items, $row);
    }

    return $items;
}

function showRecentlyAdded($item = [], $admin = false)
{
    echo 
    "<div class='col-md-4 recent-cap'>
    <div class='card mb-4 shadow-sm'>
        <img src='media/caps/",$item['image'],"' alt='",$item['brand'],"'>
        <div class='card-body p-2 p-lg-3'>
            <h5 class='card-header'>",$item['brand'],"</h5>
            <ul class='list-group list-group-flush'>
                <li class='list-group-item recent-text' title='",$item['text'],"'>",$item['text'],"</li>
                <li class='list-group-item'>",$item['color'],"</li>
                <li class='list-group-item'>",$item['country'],"</li>
            </ul>

            <div class='mt-4 d-flex justify-content-between align-items-center px-2'>
                <div class='btn-group admin-info'>",
                    $admin ? "<span class='btn btn-sm btn-outline-secondary disabled'>#".$item['id']."</span>
                    <button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button>" : ""
                ,"</div>
                <small class='text-muted'>",$item['created_date'],"</small>
            </div>
        </div>
    </div>
</div>";
}