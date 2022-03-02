<?php

class connection
{
  private $hostName = 'localhost';
  private $username = 'root';
  private $password = '';
  private $dbName = 'lann_invoice';
  public $conn;

  function __construct()
  {
    $this->conn = new mysqli($this->hostName, $this->username, $this->password, $this->dbName);

    if ($this->conn->connect_error) {
      die('Connection Failed: ' . $this->conn->connect_error);
    } else {
      return $this->conn;
    }
  }
}

// date_default_timezone_set('Asia/Makassar');
// echo date("Y-m-d H:i:s");
