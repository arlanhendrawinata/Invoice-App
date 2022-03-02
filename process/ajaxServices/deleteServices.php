<?php

include '../../database/connection.php';

class deleteServices extends connection
{
  public function deleteDataServices()
  {
    $id = $_POST['id'];
    $sql = "DELETE FROM services WHERE services_id='$id'";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Delete Data";
      return $message;
    } else {
      $message = "Failed Delete Data";
      return $message;
    }
  }
}

$obj = new deleteServices;
$data = $obj->deleteDataServices();
echo json_encode($data);
