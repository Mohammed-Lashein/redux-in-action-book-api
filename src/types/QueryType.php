<?php

namespace Src\Types;

use Core\TypeRegistry;
use Src\Types\TaskType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Src\Models\Task;

class QueryType {
  public static function generateQueryType() {
    return new ObjectType([
      'name' => 'Query',
      'fields' => [
        'tasks' => [
          'type' => Type::listOf(TypeRegistry::type(TaskType::class)),
          'resolve' => fn() => Task::all()
        ]
      ]
    ]);
  }
}