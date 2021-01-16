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