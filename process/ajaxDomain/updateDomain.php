<?php

include '../../database/connection.php';

class updateDomain extends connection
{
  public function updateDataDomain()
  {
    $id = $_POST['domain_id'];
    $name = $_POST['domain_name'];
    $annual = $_POST['domain_annual'];
    $extension = $_POST['domain_extension'];
    $sql = "UPDATE domain SET domain_name = '$name', domain_annual = '$annual', domain_extension = '$extension' WHERE domain_id = '$id'";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Update Data";
      return $message;
    } else {
      $message = "Failed Update Data";
      return $message;
    }
  }
}

$obj = new updateDomain;
$data = $obj->updateDataDomain();
echo json_encode($data);
