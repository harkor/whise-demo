<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use Whise\Api\WhiseApi;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../../../../');
$dotenv->load();

$api = new WhiseApi();
$api->setAccessToken($_SERVER['WHISE_TOKEN']);

$page = isset($_GET['page']) ? (int) $_GET['page'] : 0;

$estates = $api->estates()->list();
$list = $estates->page($page, 20);

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

echo json_encode($list);
