<?php

include '../../database/connection.php';

class ajaxGetDomain extends connection
{
  public function ajaxGetDataDomain()
  {
    $id = $_POST['idpdf'];
    $sql = "SELECT * FROM domain WHERE invoice_id = '$id'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      return $data;
    } else {
      echo '0 results';
    }
    // return $id;
  }
}

$obj = new ajaxGetDomain;
$data = $obj->ajaxGetDataDomain();
echo json_encode($data);
