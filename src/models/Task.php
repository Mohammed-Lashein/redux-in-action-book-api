<?php

namespace Src\Models;

use Core\Model;

class Task extends Model {
  protected string $table = 'tasks';
  protected array $fillable = ['title', 'description', 'status'];
}