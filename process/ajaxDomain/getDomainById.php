<?php

include '../../database/connection.php';

class ajaxGetDomain extends connection
{
  public function ajaxGetDataById()
  {
    $id = $_POST['id'];
    $sql = "SELECT * FROM domain WHERE domain_id = '$id'";
    $result = $this->conn->query($sql);

    if ($result->num_rows == 1) {
      $data = $result->fetch_assoc();
      return $data;
    } else {
      echo '0 results';
    }
  }
}

$obj = new ajaxGetDomain;
$data = $obj->ajaxGetDataById();
echo json_encode($data);
