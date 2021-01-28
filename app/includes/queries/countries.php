<?php

function getCountries()
{
    global $conn;

    $query = "SELECT `country` AS 'name', COUNT(*) AS 'amount' FROM `collection` WHERE `unknown` = 0 GROUP BY `country` ORDER BY `amount` DESC;";
    $result = mysqli_query($conn, $query);

    $countries = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        array_push($countries, $row);
    }
    
    return $countries;
}