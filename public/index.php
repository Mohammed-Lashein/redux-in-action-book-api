<?php

require __DIR__ . '/../vendor/autoload.php';

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: content-type");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Content-Type: application/json");


// For testing only, never in production !
ini_set('display_errors', 1);

use Src\Controller\TaskController;

// To return a successful response for the browser when it sends the preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/redux-in-action-book-api/graphql') {
  /* 
    Since I am using xampp, I wrote the request uri to be like so . 
    If you are using php built in server, then you would need to test against '/graphql'
  */
  TaskController::handle();
}


