<?php
include '../../database/connection.php';

class updateInvoice extends connection
{
  public function updateDataInvoice()
  {
    $invoiceCode = $_POST['invoice_code'];
    $clientId = $_POST['client'];
    $domainId = $_POST['domain'];
    $hostingId = $_POST['hosting'];
    $servicesId = $_POST['service'];
    $paidVal = $_POST['paid'];
    $total = $_POST['total'];
    $invoiceStatus = $_POST['invoice_status'];

    // $tes = gettype($invoiceStatus);

    // $test = var_dump($_POST);

    // date_default_timezone_set('Asia/Makassar');
    // $datetime = date("Y-m-d H:i:s");

    $message = "";

    // $getdatetime = $this->conn->query("SELECT invoice_datetime FROM invoice WHERE invoice_code = '$invoiceCode'");

    $sql = "UPDATE invoice 
    SET domain_id = '$domainId', services_id = '$servicesId', hosting_id = '$hostingId', invoice_paid = '$paidVal', invoice_status = '$invoiceStatus', invoice_total = '$total'
    WHERE invoice_code = '$invoiceCode'";

    $result = $this->conn->query($sql);
    if ($result) {
      $message = "Sucssess Update Data (Invoice#$invoiceCode)";
      return $message;
    } else {
      $message = "Failed Update Data (Invoice#$invoiceCode)";
      return $message;
    }
  }
}

$obj = new updateInvoice;
$data = $obj->updateDataInvoice();
echo json_encode($data);
