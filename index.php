<?php 
require_once __DIR__ . '/routes.php';

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$url = trim($url, "/");

if(array_key_exists($url, ROUTES))
{
require __DIR__ . '/app/controller/' . ROUTES[$url]["controller"];
    ROUTES[$url]["fonction"]();
}
else
{
    require __DIR__ . '/view/404.php';
}
 