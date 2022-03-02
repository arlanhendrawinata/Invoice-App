<?php

include '../../database/connection.php';

class ajaxGetServices extends connection
{
  public function ajaxGetDataServices()
  {
    $id = $_POST['idServices'];
    $sql = "SELECT services_price FROM services WHERE services_id = '$id'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      return $data;
    } else {
      echo '0 results';
    }
  }
}

$obj = new ajaxGetServices;
$data = $obj->ajaxGetDataServices();
echo json_encode($data);
