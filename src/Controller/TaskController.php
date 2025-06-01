<?php


namespace Src\Controller;

use App\Types\TaskType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use Src\Models\Task;

class TaskController {
  public static function handle() {
    $queryType = new ObjectType([
      'name' => 'Query',
      'fields' => [
        'tasks' => [
          'type' => Type::listOf(new TaskType()),
          'resolve' => fn() => Task::all()
        ]
      ]
    ]);

    $schema = new Schema([
      'query' => $queryType
    ]);
    $requestBody = file_get_contents('php://input'); // Raw JSON string from HTTP request
    $parsedBody = json_decode($requestBody, true, 10); // Associative array decoded from JSON
    $queryString = $parsedBody['query']; // The actual GraphQL query string

    try {
      $result = GraphQL::executeQuery($schema, $queryString, null, null, null);
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