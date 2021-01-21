<?php
    include "../app/includes/functions/login.php";
    if(isset($_POST['submitLogin'])) loginUser($_POST['login'], $_POST['password']);
    if(loggedIn()) headerLocation("admin");
?>

<link rel='stylesheet' href='styles/signin.css'></link>
<div class='login-page'>
    <form method='POST' class='form-signin'>
        <h1 class='mb-3 text-center'>Sign in</h1>
        <input name='login' id='inputLogin' class='form-control' type='text' placeholder='Login' required autofocus>
        <input name='password' id='inputPassword' class='form-control' type='password' placeholder='Password' required>
        <input name='submitLogin' class='btn btn-lg btn-primary btn-block' type='submit' value='Sign in'></input>
    </form>
</div>