<?php

include '../../database/connection.php';

class ajaxGetInvoiceById extends connection
{
  public function ajaxGetDataInvoiceById()
  {
    $id = $_POST['idUpdate'];

    $sql = $sql = "SELECT invoice.invoice_code, client.client_id, services.services_id, 
    services.services_price, domain.domain_id, domain.domain_extension, 
    hosting.hosting_id, hosting.hosting_extension, invoice.invoice_paid, 
    invoice.invoice_total, invoice.invoice_status
    FROM invoice
    JOIN client
    ON invoice.client_id=client.client_id
    JOIN services
    ON invoice.services_id=services.services_id
    JOIN domain
    ON invoice.domain_id=domain.domain_id
    JOIN hosting
    ON invoice.hosting_id=hosting.hosting_id
    WHERE invoice_id = $id";

    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      return $data;
    } else {
      echo '0 results';
    }
  }
}

$obj = new ajaxGetInvoiceById;
$data = $obj->ajaxGetDataInvoiceById();
echo json_encode($data);
