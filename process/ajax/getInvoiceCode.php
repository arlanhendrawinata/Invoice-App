<?php

include '../../database/connection.php';

class ajaxGetInvoiceCode extends connection
{
  public function ajaxGetDataInvoiceCode()
  {
    $sql = "SELECT max(invoice_id) as maxId FROM invoice";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      $kode = $data['maxId'];
      $kode++;
      date_default_timezone_set('Asia/Makassar');
      $date = date("Ymd");
      $autoCode = $date . sprintf('%03s', $kode);
      return $autoCode;
    } else {
      echo '0 results';
    }
  }
}

$obj = new ajaxGetInvoiceCode;
$data = $obj->ajaxGetDataInvoiceCode();
echo json_encode($data);
