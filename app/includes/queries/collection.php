<?php

function countAllRows()
{
    global $conn;

    $query = "SELECT COUNT(*) AS 'amount' FROM `collection`;";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    return $data['amount'];
}

function getItems($limit, $offset)
{
    global $conn;

    $query = "SELECT * FROM `collection` LIMIT ? OFFSET ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $items = [];
    while($row = mysqli_fetch_array($result)){
        $row['created_date'] = getDateFromDatetime($row['created_at']);
        array_push($items, $row);
    }

    return $items;
}