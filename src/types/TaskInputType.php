<?php

namespace Src\Types;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class TaskInputType extends InputObjectType {
  public function __construct() {
    $config = [
      'name' => 'TaskInput',
      'fields' => [
        'title' => Type::string(),
        'description' => Type::string(),
        'status' => Type::string()
      ]
    ];
    parent::__construct($config);
  }
}