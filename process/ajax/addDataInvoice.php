<?php
include '../../database/connection.php';

class addInvoice extends connection
{
  public function addDataInvoice()
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

    date_default_timezone_set('Asia/Makassar');
    $datetime = date("Y-m-d H:i:s");

    $message = "";

    // $sql = "INSERT INTO invoice 
    // (invoice_id, invoice_code, client_id, services_id, domain_id, hosting_id, invoice_paid, invoice_total, invoice_status, invoice_datetime)
    // VALUES (' ', $invoiceCode, $clientId, $servicesId, $domainId, $hostingId, $paidVal, $total, $status, '')";

    $sql = "INSERT INTO invoice (invoice_id, invoice_code, client_id, services_id, domain_id, hosting_id, invoice_paid, invoice_total, invoice_status, invoice_datetime) 
    VALUES ('', $invoiceCode, $clientId, $servicesId, $domainId, $hostingId, $paidVal, $total, '$invoiceStatus', '$datetime')";

    $result = $this->conn->query($sql);
    if ($result) {
      $message = "Sucssess Add Data";
      return $message;
    } else {
      $message = "Failed Add Data";
      return $message;
    }
  }
}

$obj = new addInvoice;
$data = $obj->addDataInvoice();
echo json_encode($data);
