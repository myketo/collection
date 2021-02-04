<?php

function getCountries($isos = [])
{
    global $conn;

    $query = "SELECT `country` AS 'name', COUNT(*) AS 'amount' FROM `collection` WHERE `unknown` = 0 ";
    
    if(count($isos)){
        $query .= " AND ";

        $i = 0;
        foreach($isos as $iso){
            $query .= "`country` = $iso";
            $query .= $i != count($isos) ? " OR " : "";
            $i++;
        }
    }

    $query .= " GROUP BY `country` ORDER BY `amount` DESC;";
    $result = mysqli_query($conn, $query);

    $countries = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        array_push($countries, $row);
    }
    
    return $countries;
}