<?php

namespace Core;


class Model {
  protected string $table;
  protected Database $db;
  protected array $fillable = [];
  public function __construct() {
    $this->db = new Database();
  }
  
  public static function all() {
    $instance = new static;
    return $instance->db->get('*', $instance->table);
  }
  public static function create($attributes) {
    $instance = new static;
    // foreach($data as $key => $value) {
    //   if(in_array($key, $instance->fillable)) {
    //     $instance->$key = $value;
    //   }
    // }

    if(isset($instance->fillable)) {
      $attributesThatAreAllowedToBeFilled = array_filter(
        $attributes,
        fn($key) => in_array($key, $instance->fillable),
        ARRAY_FILTER_USE_KEY
      );
    }

    $isEntityInsertedSuccessfully = $instance->db->create($attributesThatAreAllowedToBeFilled, $instance->table);

    if($isEntityInsertedSuccessfully) {
      $id = (int) $instance->db->pdo()->lastInsertId();
      $insertedEntity = $instance->db->find($id, $instance->table);
      return $insertedEntity;
    }
  }
  // the id of the model to update(i.e task in our case) will be provided within the $attributes array
  // that is coming from the query arguments, so I will change Model::update() signature
  // public static function update($id, $attributes) {
  public static function update($attributes) {
    $instance = new static;
    return $instance->db->update($attributes, $instance->table);
  }
}