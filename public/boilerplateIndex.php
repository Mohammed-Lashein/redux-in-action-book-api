<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->post('/graphql', [App\Controller\GraphQL::class, 'handle']);
});

$routeInfo = $dispatcher->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

dump("hello from idx");
dump('hello world');
$matches = [];
/* 
    Explanation of metacharacters : 
    . => Match any singular character 
        eg) .at matches 'bat' and 'rat'
    * => 
    - match zero or more of a character
    - If you used the * by itself, it will match nothing 

    Fancy combination (used in the provided .htaccess file) : 
    .* 
    => - Match zero or more occurrences of *any* character
    - Will match the whole string 


    That's what was causing a problem : 
*/
// preg_match('/.at/', 'example.com/public',$matches);
// preg_match('/.*/', 'example.com/public',$matches);
// preg_match('/graphql$/', 'example.com/graphql',$matches);
// preg_match('/^.*/', 'example.com/graphql',$matches);

// dump($matches);

// My first fetch ever in php !
// $data = file_get_contents('https://odyssey-lift-off-rest-api.herokuapp.com/tracks');
// dump(json_decode($data));


// learning regex start


// learning regex end

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        echo $handler($vars);
        break;
}