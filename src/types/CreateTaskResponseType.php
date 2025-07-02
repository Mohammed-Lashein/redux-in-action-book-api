<?php

namespace Src\Types;

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
          'type' => new TaskType()
        ]
      ]
    ];
    parent::__construct($config);
  }
}