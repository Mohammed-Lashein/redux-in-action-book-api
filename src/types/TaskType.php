<?php

namespace Src\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class TaskType extends ObjectType {
  public function __construct() {
    $config = [
      'fields' => [
        'id' => Type::id(),
        'title' => Type::string(),
        'description' => Type::string(),
        'status' => Type::string(),
      ]
    ];
    parent::__construct($config);
  }
}


