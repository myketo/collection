<?php

function addNewCap($data)
{
    global $conn;

    $query = "INSERT INTO `collection`(`brand`, `text`, `country`, `color`, `image`, `unknown`) VALUES(?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "sssssi", $data['brand'], $data['text'], $data['country'], $data['color'], $data['image'], $data['unknown']);
    
    return mysqli_stmt_execute($stmt);
}

function editCap($data)
{
    global $conn;
    $query = "UPDATE `collection` SET `brand` = ?, `text` = ?, `country` = ?, `color` = ?, `image` = ?, `unknown` = ? WHERE `id` = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "sssssii", $data['brand'], $data['text'], $data['country'], $data['color'], $data['image'], $data['unknown'], $data['id']);

    return mysqli_stmt_execute($stmt);
}

function deleteCap($id)
{
    global $conn;
    $query = "DELETE FROM `collection` WHERE `id` = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    return mysqli_stmt_execute($stmt);
}

function deleteCapImage($id)
{
    global $conn;
    $query = "UPDATE `collection` SET `image` = NULL WHERE `id` = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    return mysqli_stmt_execute($stmt);
}

function getItemById($id)
{
    global $conn;

    $query = "SELECT * FROM `collection` WHERE `id` = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_array($result);
}

function getRecentChanges($limit = 5)
{
    global $conn;

    $query = "SELECT DATE_FORMAT(`created_at`, '%Y-%m-%d') AS 'created_at', DATE_FORMAT(`updated_at`, '%Y-%m-%d') AS 'updated_at' FROM `collection` GROUP BY `created_at`, `updated_at` ORDER BY `updated_at` DESC, `created_at` DESC LIMIT $limit;";
    $result = mysqli_query($conn, $query);

    $dates = [];
    foreach($result as $row) array_push($dates, $row);

    return $dates;
}

function getActionsOnDate($date, $limit = 10)
{
    global $conn;

    $query = "SELECT `id`, `brand`, `created_at`, `updated_at` FROM `collection` WHERE `created_at` LIKE '$date%' OR `updated_at` LIKE '$date%' ORDER BY `updated_at` DESC, `created_at` DESC LIMIT $limit;";
    $result = mysqli_query($conn, $query);

    $actions = [];
    foreach($result as $row) array_push($actions, $row);

    return $actions;
}