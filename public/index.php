<?php
require_once '../app/includes/functions.php';
require_once "../app/includes/connect.php";

$get_url = isset($_GET['url']) ? $_GET['url'] : "";
$url = parseUrl($get_url);
$path = parsePath($url);

$page = $path['path'] . "/" . $path['dir'] . "/" . $path['file'];
$subpage = !empty($path['subpage']) ? $path['path'] . "/" . $path['dir'] . "/" . $path['subpage'] : "";

$title = $subpage ? title($path['subpage']) : title($path['dir']);

include "../app/pages/header.php";
require_once $subpage ? "../app/$subpage" : "../app/$page";
include "../app/pages/footer.php";