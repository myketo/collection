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