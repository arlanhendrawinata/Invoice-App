<?php
include '../../database/connection.php';

class deleteInvoice extends connection
{
  public function deleteDataInvoice()
  {
    $id = $_POST['deleteId'];
    // var_dump($_POST);
    $message = "";

    $sql = "DELETE FROM invoice WHERE invoice_id = '$id'";
    $result = $this->conn->query($sql);
    if ($result) {
      $message = "Sucssess Delete Data";
      return $message;
    } else {
      $message = "Failed Update Data";
      return $message;
    }
  }
}

$obj = new deleteInvoice;
$data = $obj->deleteDataInvoice();
echo json_encode($data);
