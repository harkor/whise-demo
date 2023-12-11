<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use Whise\Api\WhiseApi;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../../../../');
$dotenv->load();

$api = new WhiseApi();
$api->setAccessToken($_SERVER['WHISE_TOKEN']);

$estates = $api->estates()->list();
$list = $estates->page((int) $_GET['page'] ?? 0, 20);

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

echo json_encode($list);