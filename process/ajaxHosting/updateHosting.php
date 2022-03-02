<?php

include '../../database/connection.php';

class updateHosting extends connection
{
  public function updateDataHosting()
  {
    $id = $_POST['hosting_id'];
    $name = $_POST['hosting_name'];
    $annual = $_POST['hosting_annual'];
    $extension = $_POST['hosting_extension'];
    $sql = "UPDATE hosting SET hosting_name = '$name', hosting_annual = '$annual', hosting_extension = '$extension' WHERE hosting_id = '$id'";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Update Data";
      return $message;
    } else {
      $message = "Failed Update Data";
      return $message;
    }
  }
}

$obj = new updateHosting;
$data = $obj->updateDataHosting();
echo json_encode($data);
