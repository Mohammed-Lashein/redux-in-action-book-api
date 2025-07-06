<?php

namespace Src\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Src\Models\Task;

class MutationType extends ObjectType {
  public function __construct() {
    parent::__construct([
      // No need to explicitly set the name since we are extending ObjectType
      // 'name' => 'Mutation',
      'fields' => [
        'createTask' => [
          'type' => new CreateTaskResponseType(),
          'args' => [
          'newTaskDetails' => [
          'type' => new TaskInputType()
          ]
          ],
          'resolve' => function($_parent, $args) {
            $newTaskDetails = $args['newTaskDetails'];
            $createdTask = Task::create([
              'title' => $newTaskDetails['title'],
              'description' => $newTaskDetails['description'],
              'status' => $newTaskDetails['status']
            ]);

            if(!is_null($createdTask)) {
              return [
                'code' => 200,
                'success' => true,
                'message' => 'The task was created successfully!',
                'task' => $createdTask
              ];
            }

            return [
              'code' => 500,
              'success' => false,
              'message' => 'There was an error, the task could not be created',
              'task' => null
            ];
          },
        ],
        'updataTaskStatus' => [
          'type' => new UpdateTaskStatusResponseType(),
                    'args' => [
            'id' => Type::id(),
            'status' => Type::string(),
          ],
          'resolve' => function($_parent, $args) {
            // to resolve!
          }
        ]
      ]
    ]);
  }
}