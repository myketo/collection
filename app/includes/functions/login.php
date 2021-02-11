<?php


/**
 * Check user login and password and try to sign in
 * @param string $login login inputed by the user
 * @param string $password password inputed by the user
 */
function loginUser($login, $password)
{
    // second option for password storing: php.ini and then get_cfg_var()
    
    // include the file containing hashed user data
    $admin = require "../app/includes/user.php";
    
    // if login or password do not match the admin data
    if($login != $admin['login'] || !password_verify($password, $admin['password'])){
        // then return with an alert
        return showAlert("Failed to login.", "danger");
    }

    // otherwise set logged_in to true
    $_SESSION['logged_in'] = true;
}