<?php

include '../../database/connection.php';

class ajaxGetHosting extends connection
{
  public function ajaxGetDataHosting()
  {
    $id = $_POST['idHosting'];
    $sql = "SELECT hosting_extension FROM hosting WHERE hosting_id = '$id'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      return $data;
    } else {
      echo '0 results';
    }
  }
}

$obj = new ajaxGetHosting;
$data = $obj->ajaxGetDataHosting();
echo json_encode($data);
