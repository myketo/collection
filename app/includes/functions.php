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

    if(isset($url[0]) && file_exists(__DIR__  . "/../$path/{$url[0]}/$file")){
        $dir = $url[0];
    }

    if(isset($url[1]) && file_exists(__DIR__ . "/../$path/$dir/{$url[1]}.php")){
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