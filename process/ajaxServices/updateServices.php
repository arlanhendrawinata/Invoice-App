<?php

include '../../database/connection.php';

class updateServices extends connection
{
  public function updateDataServices()
  {
    $id = $_POST['services_id'];
    $name = $_POST['services_name'];
    $price = $_POST['services_price'];
    $sql = "UPDATE services SET services_name = '$name', services_price = '$price' WHERE services_id = '$id'";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Update Data";
      return $message;
    } else {
      $message = "Failed Update Data";
      return $message;
    }
  }
}

$obj = new updateServices;
$data = $obj->updateDataServices();
echo json_encode($data);
