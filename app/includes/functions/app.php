<?php

function parseUrl($url = ""){
    return explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
}

function parsePath($url = [])
{
    $base = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/";
    $path = "pages";       // default path
    $dir = "home";          // default directory
    $file = "index.php";    // default file
    $subpage = "";          // default subpage

    if(isset($url[0]) && file_exists(__DIR__  . "/../../$path/{$url[0]}/$file")){
        $dir = $url[0];
    }

    if(isset($url[1]) && file_exists(__DIR__ . "/../../$path/$dir/{$url[1]}.php")){
        $subpage = "{$url[1]}.php";
    }

    return [
        "base" => $base,
        "path" => $path,
        "dir" => $dir,
        "file" => $file,
        "subpage" => $subpage
    ];
}

function title($dir = "")
{
    $dir = str_replace(".php", "", $dir);

    $title = "Bottle Caps Collection";

    if($dir != "" && $dir != "home") $title = ucfirst($dir) . " | " . $title;

    return $title;
}

function getDateFromDatetime($datetime)
{
    $dt = new DateTime($datetime);
    $created_date = $dt->format('Y-m-d');
    
    return $created_date;
}

function headerLocation($location)
{
    // check for "home" location and redirect to main subpage, replace ".." and "." in files
    header("Location: " . $location);
    die();
    exit;
}

function getQueryValue($variable)
{
    return filter_input(INPUT_GET, $variable, FILTER_SANITIZE_STRING);
}

function queryExists($name, $value, $return)
{
    if(isset($_GET[$name]) && ($_GET[$name] == $value)){
        return $return;
    }
}

function showAlert($msg, $color, $die = false)
{
    echo "<p class='alert-$color'>$msg</p>";

    if($die){
        include "../app/pages/footer.php";
        die();
    }
}

function loggedIn()
{
    return isset($_SESSION['logged_in']);
}

function logout($url)
{
    if($url != "logout") return;

    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
    }
    
    headerLocation(".");
}

function getCountryISO($country)
{
    $countries = include "../app/includes/countries_array.php";

    $input = ucwords($country);
    $input = preg_quote($input, '~');

    $result = preg_grep("~$input~", $countries);
    return count($result) ? array_keys($result) : [$country];
}