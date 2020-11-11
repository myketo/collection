<?php

require_once '../app/includes/functions.php';

$get_url = isset($_GET['url']) ? $_GET['url'] : "";
$url = parseUrl($get_url);
$path = parsePath($url);

$page = $path['path'] . "/" .$path['dir'] . "/" . $path['file'];
$subpage = $path['path'] . "/" .$path['dir'] . "/" . $path['subpage'];

$title = ucfirst($path['dir']);

require_once "../app/$page";