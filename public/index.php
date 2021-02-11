<?php
session_start();

date_default_timezone_set("Europe/Warsaw");

require_once "../app/includes/connect.php";
require_once '../app/includes/functions/app.php';

$get_url = isset($_GET['url']) ? $_GET['url'] : "";
$path = routingPath(parseUrl($get_url));

logout($get_url);

include "../app/includes/functions/collection.php";
$url = filterUrlData($_GET);

$page = $path['path'] . "/" . $path['dir'] . "/" . $path['file'];
$subpage = !empty($path['subpage']) ? $path['path'] . "/" . $path['dir'] . "/" . $path['subpage'] : "";
$title = $subpage ? title($path['subpage']) : title($path['dir']);

include "../app/pages/header.php";
require_once $subpage ? "../app/$subpage" : "../app/$page";
include "../app/pages/footer.php";