<?php

include '../../database/connection.php';

class deleteDomain extends connection
{
  public function deleteDataDomain()
  {
    $id = $_POST['id'];
    $sql = "DELETE FROM domain WHERE domain_id='$id'";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Delete Data";
      return $message;
    } else {
      $message = "Failed Delete Data";
      return $message;
    }
  }
}

$obj = new deleteDomain;
$data = $obj->deleteDataDomain();
echo json_encode($data);
