<?php

include '../../database/connection.php';

class ajaxAddDomain extends connection
{
  public function ajaxAddDataDomain()
  {
    $name = $_POST['domain_name'];
    $annual = $_POST['domain_annual'];
    $extension = $_POST['domain_extension'];

    $sql = "INSERT INTO domain (domain_name, domain_annual, domain_extension)
    VALUES ('$name', '$annual', '$extension')";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Add Data";
      return $message;
    } else {
      $message = "Failed Add Data";
      return $message;
    }
  }
}

$obj = new ajaxAddDomain;
$data = $obj->ajaxAddDataDomain();
echo json_encode($data);
