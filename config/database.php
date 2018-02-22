<?php
/**
 * Class For Database
 */
class Database
{
  private $dbName = 'mysql:dbname=foodedu;host:127.0.0.1';
  private $user = 'root';
  private $pass = '';
  public $conn;

  public function Connect($value=''){
    try {
      $this->conn = new PDO($this->dbName,$this->user,$this->pass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('Connection Failed ' . $e->getMessage());
    }
    return $this->conn;
  }
}

 ?>
