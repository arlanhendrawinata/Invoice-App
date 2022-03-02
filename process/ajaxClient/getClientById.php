<?php

include '../../database/connection.php';

class ajaxGetClient extends connection
{
  public function ajaxGetDataById()
  {
    $id = $_POST['id'];
    $sql = "SELECT * FROM client WHERE client_id = '$id'";
    $result = $this->conn->query($sql);

    if ($result->num_rows == 1) {
      $data = $result->fetch_assoc();
      return $data;
    } else {
      echo '0 results';
    }
  }
}

$obj = new ajaxGetClient;
$data = $obj->ajaxGetDataById();
echo json_encode($data);
