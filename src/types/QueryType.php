<?php

namespace Src\Types;

use App\Types\TaskType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Src\Models\Task;

class QueryType {
  public static function generateQueryType() {
    return new ObjectType([
      'name' => 'Query',
      'fields' => [
        'tasks' => [
          'type' => Type::listOf(new TaskType()),
          'resolve' => fn() => Task::all()
        ]
      ]
    ]);
  }
}