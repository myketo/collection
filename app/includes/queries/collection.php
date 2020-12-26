<?php

function countAllRows($search = "")
{
    global $conn;

    $query = "SELECT COUNT(*) AS 'amount' FROM `collection`";

    if(!empty($search)){
        $query .= " WHERE ";
        $columns = ['brand', 'text', 'country', 'color', 'created_at'];
        
        $i = 1;
        foreach($columns as $column){
            $query .= "`$column` LIKE '%$search%'";
            $query .= $i != count($columns) ? " OR " : ";";
            $i++;
        }
    }

    $result = mysqli_query($conn, $query);

    $data = mysqli_fetch_array($result);

    return $data['amount'];
}

function getItems($sort_by, $order_by, $limit, $offset, $search = "")
{
    global $conn;

    $query = "SELECT * FROM `collection`";

    if(!empty($search)){
        $query .= " WHERE ";
        $columns = ['brand', 'text', 'country', 'color', 'created_at'];

        $i = 1;
        foreach($columns as $column){
            $query .= "`$column` LIKE '%$search%'";
            $query .= $i != count($columns) ? " OR " : "";
            $i++;
        }
    }

    $query .= " ORDER BY `$sort_by` $order_by LIMIT $limit OFFSET $offset;";
    $result = mysqli_query($conn, $query);

    $items = [];
    while($row = mysqli_fetch_array($result)){
        $row['created_date'] = getDateFromDatetime($row['created_at']);
        array_push($items, $row);
    }

    return $items;
}