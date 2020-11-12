<?php

function parseUrl($url = ""){
    return explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
}

function parsePath($url = [])
{
    $path = "pages/";       // default path
    $dir = "home";          // default directory
    $file = "index.php";    // default file
    $subpage = "";          // default subpage

    if(isset($url[0]) && file_exists("$path/{$url[0]}/$file")){
        $dir = "{$url[0]}";
    }

    if(isset($url[1]) && file_exists("$dir/{$url[1]}.php")){
        $subpage = "{$url[1]}.php";
    }

    return [
        "path" => $path,
        "dir" => $dir,
        "file" => $file,
        "subpage" => $subpage
    ];
}

function title($dir = "")
{
    $title = "Bottle Caps Collection";
    if($dir != "" && $dir != "home") $title = ucfirst($dir) . " | " . $title;

    return $title;
}