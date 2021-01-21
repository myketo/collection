<?php

function loginUser($login, $password)
{
    // second option for password storing: php.ini and then get_cfg_var()
    $admin = require "../app/includes/user.php";
    
    if($login != $admin['login'] || !password_verify($password, $admin['password'])){
        return showAlert("Failed to login.", "danger");
    }

    $_SESSION['logged_in'] = true;
}