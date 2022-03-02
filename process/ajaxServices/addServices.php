<?php

include '../../database/connection.php';

class ajaxAddServices extends connection
{
  public function ajaxAddDataServices()
  {
    $name = $_POST['services_name'];
    $price = $_POST['services_price'];

    $sql = "INSERT INTO services (services_name, services_price)
    VALUES ('$name', '$price')";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Add Data";
      return $message;
    } else {
      $message = "Failed Add Data";
      return $message;
    }
  }
}

$obj = new ajaxAddServices;
$data = $obj->ajaxAddDataServices();
echo json_encode($data);
