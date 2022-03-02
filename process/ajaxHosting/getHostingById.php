<?php

include '../../database/connection.php';

class ajaxGetHosting extends connection
{
  public function ajaxGetDataById()
  {
    $id = $_POST['id'];
    $sql = "SELECT * FROM hosting WHERE hosting_id = '$id'";
    $result = $this->conn->query($sql);

    if ($result->num_rows == 1) {
      $data = $result->fetch_assoc();
      return $data;
    } else {
      echo '0 results';
    }
  }
}

$obj = new ajaxGetHosting;
$data = $obj->ajaxGetDataById();
echo json_encode($data);
