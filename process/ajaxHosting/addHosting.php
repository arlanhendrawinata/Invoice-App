<?php

include '../../database/connection.php';

class ajaxAddHosting extends connection
{
  public function ajaxAddDataHosting()
  {
    $name = $_POST['hosting_name'];
    $annual = $_POST['hosting_annual'];
    $extension = $_POST['hosting_extension'];

    $sql = "INSERT INTO hosting (hosting_name, hosting_annual, hosting_extension)
    VALUES ('$name', '$annual', '$extension')";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Add Data";
      return $message;
    } else {
      $message = "Failed Add Data";
      return $message;
    }
  }
}

$obj = new ajaxAddHosting;
$data = $obj->ajaxAddDataHosting();
echo json_encode($data);
