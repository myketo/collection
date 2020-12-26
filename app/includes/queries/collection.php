<?php

function countAllRows()
{
    global $conn;

    $query = "SELECT COUNT(*) AS 'amount' FROM `collection`;";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    return $data['amount'];
}

function getItems($sort_by, $order_by, $limit, $offset)
{
    global $conn;

    $query = "SELECT * FROM `collection` ORDER BY `$sort_by` $order_by LIMIT $limit OFFSET $offset;";
    $result = mysqli_query($conn, $query);

    $items = [];
    while($row = mysqli_fetch_array($result)){
        $row['created_date'] = getDateFromDatetime($row['created_at']);
        array_push($items, $row);
    }

    return $items;
}