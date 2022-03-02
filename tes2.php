<?php


include './process/process.php';

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();


$id = $_GET['pdf'];

$obj = new invoice;
$data = $obj->displayInvoiceById($id);

$html = '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INVOICE #<?= $data['invoice_code'] ?></title>
  <!-- <link rel="stylesheet" href="http://localhost/lann/dist/css/main.css"> -->
</head>

<style>
  .wrapper {
    width: 595px;
    height: 842px;
    background-color: bisque;
  }

  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  .head-invoice {
    width: 100%;
    height: 210px;
    padding: 40px;
    background-color: #f8f7fa;
  }

  h1 {
    font-size: 28px;
  }

  .company-logo img {
    width: 50px;
  }

  .company-logo {
    width: 50%;
    float: left;
    background-color: aqua;
  }

  .invoice-code {
    width: 50%;
    float: right;
    background-color: aquamarine;
  }

  .invoice-code-detail h1,
  .invoice-number {
    padding-bottom: 10px;
  }

  /* .invoice-number {
  display: flex;
  flex-direction: column;
} */

  .invoice-bill {
    padding: 40px;
  }

  .bill-to {
    width: 50%;
    float: left;
  }

  .bill-from {
    width: 50%;
    float: right;
  }

  .bill-from-content {
    float: left;
  }

  .bill-to-item {
    display: block;
    text-transform: capitalize;
    padding: 5px;
  }

  table {
    width: 100%;
    padding: 40px;
    border-collapse: collapse;
  }

  thead {
    background-color: var(--color-background);
  }

  th {
    text-align: left;
    text-transform: uppercase;
    font-family: Inter-SemiBold;
    /* font-size: 1.2em; */
    /* background-color: var(--color-background);*/
    padding: 20px 0 0px 0;
  }

  td {
    padding: 10px 0;
  }

  td {
    text-align: left;
  }

  th:nth-child(1),
  td:nth-child(1) {
    padding-left: 40px;
  }

  th:nth-child(4),
  td:nth-child(4) {
    padding-right: 40px;
  }

  .divider {
    border-top: 1px solid var(--color-grey);
  }
</style>

<body>
  <div class="wrapper">
    <div class="head-invoice">
      <div class="company-logo">
        <img src="http://localhost/lann/dist/img/Logo.png" alt="lann_logo">
      </div>
      <div class="invoice-code">
        <div class="invoice-code-detail">
          <h1>Invoice</h1>
          <div class="invoice-number">
            <h3>Invoice Number:</h3>
            <span><?= $data['invoice_code'] ?></span>
          </div>
          <div class="invoice-date">
            <h3>Date</h3>
            <?= $invoiceDate = $data['invoice_datetime'];
            $date = date('d-m-Y', strtotime($invoiceDate));
            echo '<span>' . $date . '</span>' ?>
          </div>
        </div>
      </div>
    </div>
    <div class="invoice-bill">
      <div class="bill-to">
        <h3 class="bill-to-item">Bill To</h3>
        <span class="bill-to-item"><?= $data['client_name'] ?></span>
        <span class="bill-to-item"><?= $data['company_name'] ?></span>
        <span class="bill-to-item"><?= $data['client_email'] ?></span>
        <span class="bill-to-item"><?= $data['client_phone'] ?></span>
      </div>
      <div class="bill-from">
        <div class="bill-from-content">
          <h3 class="bill-to-item">Bill From</h3>
          <span class="bill-to-item">LANN.</span>
          <span class="bill-to-item">lann@gmail.com</span>
          <span class="bill-to-item">085xxxxxxxxx</span>
          <span class="bill-to-item">Bali 80xxx</span>
        </div>
      </div>
    </div>
    <table>
      <thead>
        <tr>
          <th>Item</th>
          <th>Cost</th>
          <th>Qty</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <tr class="tr-body">
          <td width="55%"><?= $data['services_name'] ?></td>
          <td width="15%">Rp.<?= $data['services_price'] ?></td>
          <td width="15%">
            <?= $qty_services = 1;
            echo $qty_services ?>
          </td>
          <td width="15%">
            <?= $total_item_services = $qty_services * intval($data['services_price']);
            echo "Rp." . $total_item_services ?>
          </td>
        </tr>
        <tr class="tr-body">
          <td width="55%"><?= $data['domain_name'] ?></td>
          <td width="15%">Rp.<?= $data['domain_extension'] ?></td>
          <td width="15%"><?= $qty_domain = 1;
                          echo $qty_domain ?></td>
          <td width="15%"><?= $total_item_domain = $qty_domain * intval($data['domain_extension']);
                          echo "Rp." . $total_item_domain ?></td>
        </tr>
        <tr class="tr-body">
          <td width="55%"><?= $data['hosting_name'] ?></td>
          <td width="15%">Rp<?= $data['hosting_extension'] ?></td>
          <td width="15%"><?= $qty_hosting = 1;
                          echo $qty_hosting ?></td>
          <td width="15%"><?= $total_item_hosting = $qty_hosting * intval($data['hosting_extension']);
                          echo "Rp." . $total_item_hosting ?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" class="divider">Subtotal</td>
          <td class="divider">
            <?= $subtotal = $total_item_services + $total_item_domain + $total_item_hosting;
            echo "Rp." . $subtotal ?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="">Total</td>
          <td>Rp.<?= $subtotal ?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" class="divider">Paid</td>
          <td class="divider">Rp.<?= $data['invoice_paid'] ?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2">Amount Due</td>
          <td><?= $total = $subtotal - intval($data['invoice_paid']);
              echo "Rp." . $total ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>;

<?php
// $mpdf->WriteHTML('<h1>Hello world!</h1>');
// $mpdf->Output();
?>