<?php

include '../../database/connection.php';

class ajaxGetDomain extends connection
{
  public function ajaxGetDataDomain()
  {
    $id = $_POST['idDomain'];
    $sql = "SELECT domain_extension FROM domain WHERE domain_id = '$id'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      return $data;
    } else {
      echo '0 results';
    }
  }
}

$obj = new ajaxGetDomain;
$data = $obj->ajaxGetDataDomain();
echo json_encode($data);
