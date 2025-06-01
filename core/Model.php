<?php

namespace Core;


class Model {
  protected string $table;
  protected Database $db;
  public function __construct() {
    $this->db = new Database();
  }
  public function all() {
    return $this->db->get('*', $this->table);
  }
}