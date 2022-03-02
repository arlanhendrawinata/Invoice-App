<?php

include '../../database/connection.php';

class deleteHosting extends connection
{
  public function deleteDataHosting()
  {
    $id = $_POST['id'];
    $sql = "DELETE FROM hosting WHERE hosting_id='$id'";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Delete Data";
      return $message;
    } else {
      $message = "Failed Delete Data";
      return $message;
    }
  }
}

$obj = new deleteHosting;
$data = $obj->deleteDataHosting();
echo json_encode($data);
