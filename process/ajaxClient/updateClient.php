<?php

include '../../database/connection.php';

class updateClient extends connection
{
  public function updateDataClient()
  {
    $id = $_POST['client_id'];
    $name = $_POST['name'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE client SET client_name = '$name', company_name = '$company', client_email = '$email', client_phone = '$phone' WHERE client_id = '$id'";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Update Data";
      return $message;
    } else {
      $message = "Failed Update Data";
      return $message;
    }
  }
}

$obj = new updateClient;
$data = $obj->updateDataClient();
echo json_encode($data);
