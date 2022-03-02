<?php

include './database/connection.php';

class invoice extends connection
{
  public function displayInvoice()
  {
    $sql = "SELECT invoice.invoice_id, invoice.invoice_code, client.company_name, client.client_name, 
    services.services_name, services.services_price, 
    domain.domain_name, domain.domain_extension, domain.domain_annual, 
    hosting.hosting_name, hosting.hosting_extension, hosting.hosting_annual, 
    invoice.invoice_paid, invoice.invoice_total, invoice.invoice_status, invoice.invoice_datetime
    FROM invoice
    JOIN client
    ON invoice.client_id=client.client_id
    JOIN services
    ON invoice.services_id=services.services_id
    JOIN domain
    ON invoice.domain_id=domain.domain_id
    JOIN hosting
    ON invoice.hosting_id=hosting.hosting_id
    ORDER BY invoice_id DESC";

    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
    } else {
      echo '<span class="alert">No data found</span>';
    }
  }

  public function displayInvoiceById($id)
  {
    $sql = "SELECT invoice.invoice_id, invoice.invoice_code, client.company_name, client.client_name, client.client_email, client.client_phone,
    services.services_name, services.services_price, 
    domain.domain_name, domain.domain_extension, domain.domain_annual, 
    hosting.hosting_name, hosting.hosting_extension, hosting.hosting_annual, 
    invoice.invoice_paid, invoice.invoice_total, invoice.invoice_status, invoice.invoice_datetime
    FROM invoice
    JOIN client
    ON invoice.client_id=client.client_id
    JOIN services
    ON invoice.services_id=services.services_id
    JOIN domain
    ON invoice.domain_id=domain.domain_id
    JOIN hosting
    ON invoice.hosting_id=hosting.hosting_id
    WHERE invoice_id = '$id'";

    $result = $this->conn->query($sql);
    if ($result->num_rows == 1) {
      $data = $result->fetch_assoc();
      return $data;
    } else {
      echo '<span class="alert">No data found</span>';
    }
  }
}

class client extends connection
{
  public function displayClient()
  {
    $sql = 'SELECT * FROM client ORDER BY client_id DESC';
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $datas[] = $row;
      }
      return $datas;
    } else {
      echo '0 results';
    }
  }
}

class domain extends connection
{
  public function displayDomain()
  {
    $sql = 'SELECT * FROM domain ORDER BY domain_id DESC';
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $datas[] = $row;
      }
      return $datas;
    } else {
      echo '0 results';
    }
  }
}

class hosting extends connection
{
  public function displayHosting()
  {
    $sql = 'SELECT * FROM hosting ORDER BY hosting_id DESC';
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $datas[] = $row;
      }
      return $datas;
    } else {
      echo '0 results';
    }
  }
}

class services extends connection
{
  public function displayServices()
  {
    $sql = 'SELECT * FROM services ORDER BY services_id DESC';
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $datas[] = $row;
      }
      return $datas;
    } else {
      echo '0 results';
    }
  }
}
