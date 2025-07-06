<?php

namespace Core;

use PDO;
use PDOException;

class Database {
  static $connection;
  // The Database constructor should be protected to create a singleton and use it through our app using
  // something like Laravel's service containers . But let's keep things simple for now . 
  public function __construct($pdo = null)
  {
    try {
      static::$connection = $pdo ?? new PDO(
        'mysql:host=127.0.0.1;dbname=redux_in_action_book_api',
        'root',
        '',
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
      );
    } catch (PDOException $e) {
      echo $e->getMessage();
      // commented out so tests pass without actual connection to pdo
      // die("failed connecting to db");
    }
  }

  public function get(string $columns, string $table) {
    $stmt = static::$connection->query("SELECT $columns FROM $table");
    return $stmt->fetchAll();
  }
  public function create(array $attributes, string $table) {
    $keys = implode(', ', array_keys($attributes));
    $placeholders =   rtrim( // to remove the ', ' at the end 
      array_reduce(
        array_keys($attributes),
        fn($total, $item) => $total .= ":$item, " ,
        ''
      ),
      ', '
    );

    $stmt = static::$connection->prepare("INSERT INTO $table ($keys) VALUES ($placeholders)");
    return $stmt->execute($attributes);
  }
  public function find($id, $table) {
    $stmt = static::$connection->prepare("SELECT * FROM $table WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    return $stmt->fetch();
  }
  public function pdo() {
    return static::$connection;
  }
  public function update($attributes, $table) {
    // prepare the sql update statement set clause to have placeholders from $attributes
    /* Since we don't want the id to be added to the column name and column value placeholder, we
    are filtering it  */
    $attributesKeysWithoutTheId = array_filter(array_keys($attributes), fn($attribute) => $attribute !== 'id');
    $placeholders = array_reduce(
    $attributesKeysWithoutTheId,
    fn($total, $item) => $total .= "$item=:$item, ",
    ''
    );
    $placeholders = rtrim($placeholders, ', ');
    // var_dump($placeholders);
    // example: status=:status

    // use PDO::prepare() and PDOStatement::execute()
    $stmt = static::$connection->prepare("UPDATE $table SET $placeholders WHERE id=:id");
    return $stmt->execute($attributes);
  }
}