<?php

require __DIR__ . '/../vendor/autoload.php';

// For testing only, never in production !
ini_set('display_errors', 1);

use Src\Controller\TaskController;

if($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/redux-in-action-book-api/graphql') {
  /* 
    Since I am using xampp, I wrote the request uri to be like so . 
    If you are using php built in server, then you would need to test against '/graphql'
  */
  TaskController::handle();
}


