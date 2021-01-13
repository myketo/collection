<?php

function getCountries()
{
    global $conn;

    $query = "SELECT `country` AS 'name', COUNT(*) AS 'amount' FROM `collection` WHERE `unknown` = 0 GROUP BY `country` ORDER BY `amount` DESC;";
    $result = mysqli_query($conn, $query);

    $countries = [];
    while($row = mysqli_fetch_array($result)){
        $row['filename'] = iconv('utf-8', 'ascii//TRANSLIT', $row['name']);
        $row['filename'] = strtolower(str_replace(" ", "-", $row['filename']));

        $row['filename'] = str_replace("'", "", $row['filename']);
        array_push($countries, $row);
    }
    
    return $countries;
}