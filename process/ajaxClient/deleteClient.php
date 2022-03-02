<?php

include '../../database/connection.php';

class deleteClient extends connection
{
  public function deleteDataClient()
  {
    $id = $_POST['id'];
    $sql = "DELETE FROM client WHERE client_id='$id'";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Delete Data";
      return $message;
    } else {
      $message = "Failed Delete Data";
      return $message;
    }
  }
}

$obj = new deleteClient;
$data = $obj->deleteDataClient();
echo json_encode($data);
