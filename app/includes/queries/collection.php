<?php

function countAllRows($search = "", $field = "", $country = "", $unknown = false)
{
    global $conn;

    $query = "SELECT COUNT(*) AS 'amount' FROM `collection`";

    if(!empty($country)) $query .= "WHERE `country` = '$country'";

    if(!empty($search)){
        $query .= " WHERE ";
        $columns = ['brand', 'text', 'country', 'color', 'created_at'];
        
        if(!empty($field)){
            if($field == "country"){
                $search = getCountryISO($search);
                $i = 1;
                foreach($search as $iso){
                    $query .= "`$field` = '$iso'";
                    $query .= $i != count($search) ? " OR " : "";
                    $i++;
                }
            }else{
                $query .= "`$field` LIKE '%$search%'";
            }
        }else{
            $i = 1;
            foreach($columns as $column){
                $query .= "`$column` LIKE '%$search%'";
                $query .= $i != count($columns) ? " OR " : "";
                $i++;
            }
        }
    }

    if($unknown) $query .= " WHERE `unknown` = 1;";

    $result = mysqli_query($conn, $query);

    $data = mysqli_fetch_array($result);

    return $data['amount'];
}

function getItems($sort_by, $order_by, $limit, $offset, $search = "", $field = "", $country = "", $unknown = false)
{
    global $conn;

    $query = "SELECT * FROM `collection`";

    if(!empty($country)) $query .= "WHERE `country` = '$country'";

    if(!empty($search)){
        $query .= " WHERE ";
        $columns = ['brand', 'text', 'country', 'color', 'created_at'];

        if(!empty($field)){
            if($field == "country"){
                $search = getCountryISO($search);
                $i = 1;
                foreach($search as $iso){
                    $query .= "`$field` = '$iso'";
                    $query .= $i != count($search) ? " OR " : "";
                    $i++;
                }
            }else{
                $query .= "`$field` LIKE '%$search%'";
            }
        }else{
            $i = 1;
            foreach($columns as $column){
                $query .= "`$column` LIKE '%$search%'";
                $query .= $i != count($columns) ? " OR " : "";
                $i++;
            }
        }
    }

    if($unknown) $query .= " WHERE `unknown` = 1";

    $query .= " ORDER BY `$sort_by` $order_by LIMIT $limit OFFSET $offset;";
    $result = mysqli_query($conn, $query);

    $items = [];
    while($row = mysqli_fetch_array($result)){
        $row['created_date'] = getDateFromDatetime($row['created_at']);
        array_push($items, $row);
    }

    return $items;
}