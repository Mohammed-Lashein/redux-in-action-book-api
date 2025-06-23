<?php

namespace Core;


class Model {
  protected string $table;
  protected Database $db;
  public function __construct() {
    $this->db = new Database();
  }
  /* 
    Why didn't we create this method as static instead of being forced every time we call it to create a 
    new instance of the Model ?
    => Because if Model::all() was static, we won't have the ability to access $this->db inside it.

    We would then need a Registry (Similar to laravel's service container) which initializes the Database
    only once and shares that instance throughout the project.

    I didn't want to add more unnecessary complexity to the code, that's why I took the current approach
  */
  public function all() {
    return $this->db->get('*', $this->table);
  }
}