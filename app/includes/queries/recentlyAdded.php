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