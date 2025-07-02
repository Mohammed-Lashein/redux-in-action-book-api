<?php


namespace Src\Controller;

use GraphQL\Error\DebugFlag;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use Src\Types\MutationType;
use Src\Types\QueryType;

class TaskController {
  public static function handle() {
    $queryType = QueryType::generateQueryType();
    $mutationType = new MutationType();

    $schema = new Schema([
      'query' => $queryType,
      'mutation' => $mutationType
    ]);
    $requestBody = file_get_contents('php://input'); // Raw JSON string from HTTP request
    $parsedBody = json_decode($requestBody, true, 10); // Associative array decoded from JSON
    $queryString = $parsedBody['query']; // The actual GraphQL query string

    $variables = $parsedBody['variables'];

    try {
      $result = GraphQL::executeQuery($schema, $queryString, null, null, $variables);
      $result = $result->toArray(DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE);
    } catch (\Throwable $e) {
      //throw $th;
      // no need to manually add 'error' to the result as graphql-php automatically returns errors 
      // when we encounter them . 
      // $result = [
      //   'error' => $e->getMessage()
      // ];
      echo $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($result);
  }
}