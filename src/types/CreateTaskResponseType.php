<?php

namespace Src\Types;

use Core\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CreateTaskResponseType extends ObjectType {
  public function __construct() {
    $config = [
      'fields' => [
        'code' => Type::int(),
        'success' => Type::boolean(),
        'message' => Type::string(),
        'task' => [
          'type' => TypeRegistry::type(TaskType::class)
        ]
      ]
    ];
    parent::__construct($config);
  }
}