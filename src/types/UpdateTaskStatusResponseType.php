<?php

namespace Src\Types;

use Core\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UpdateTaskStatusResponseType extends ObjectType {
  public function __construct() {
    $config = [
      'fields' => [
        'code' => Type::int(),
        'success' => Type::boolean(),
        'message' => Type::string(),
        'task' => TypeRegistry::type(TaskType::class)
      ]
    ];
    parent::__construct($config);
  }
}