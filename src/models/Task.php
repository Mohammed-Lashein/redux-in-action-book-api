<?php

namespace Src\Models;

class Task {
  public static function all() {
    return [
      [
        'id' => 1,
        'title' => 'hello world !',
        'description' => 'amz task',
        'status' => 'In progress'
      ],
      [
        'id' => 2,
        'title' => 'hello world 2!',
        'description' => 'amz task 2',
        'status' => 'In progress --not started'
      ]
    ];
  }
}