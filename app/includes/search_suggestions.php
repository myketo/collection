<?php

function findSuggestions($search, $field)
{
    if(empty($search) || strlen($search) < 2) return;
    if(empty($field)) $field = 'brand';
    $suggestions = getSuggestions($search, $field);
    return json_encode($suggestions);
}

function getSuggestions($search, $field, $limit = 5)
{
    include "connect.php";

    if($field == "country"){
        return getCountriesSuggestions($search, $limit);
    }

    $search = "$search%";

    $query = "SELECT `brand` FROM `collection` WHERE $field LIKE ? GROUP BY `brand` ORDER BY `brand` LIMIT ?;";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "si", $search, $limit);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $data = [];
    foreach($result as $row){
        array_push($data, $row['brand']);
    }

    return $data;
}

function getCountriesSuggestions($search, $limit)
{
    include "connect.php";

    $countries = include "countries_array.php";

    $input = ucwords($search);
    $input = preg_quote($input, '~');

    $isos = preg_grep("~$input~", $countries);
    $isos = count($isos) ? array_keys($isos) : [$search];

    $query = "SELECT `country` FROM `collection` WHERE ";

    $i = 1;
    foreach($isos as $iso){
        $query .= " `country` = '$iso'";
        $query .= $i != count($isos) ? " OR " : "";
        $i++;
    }

    $query .= " GROUP BY `country` LIMIT $limit;";
    $result = mysqli_query($conn, $query);

    $data = [];
    foreach($result as $row){
        array_push($data, $row['country']);
    }

    for($i = 0; $i < count($data); $i++){
        $data[$i] = $countries[$data[$i]];
    }

    return $data;
}

echo findSuggestions($_POST['search'], $_POST['field']);