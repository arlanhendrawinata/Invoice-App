<?php

include '../../database/connection.php';

class ajaxAddClient extends connection
{
  public function ajaxAddDataClient()
  {
    $name = $_POST['name'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO client (client_name, client_email, client_phone, company_name)
    VALUES ('$name', '$email', '$phone', '$company')";

    if ($result = $this->conn->query($sql)) {
      $message = "Sucssess Add Data";
      return $message;
    } else {
      $message = "Failed Add Data";
      return $message;
    }
  }
}

$obj = new ajaxAddClient;
$data = $obj->ajaxAddDataClient();
echo json_encode($data);
