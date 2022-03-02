<?php
include './process/process.php';

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => 0, 'margin_right' => 0, 'margin_top' => 0, 'margin_bottom' => 0, 'margin_header' => 0, 'margin_footer' => 0]); //use this customization

$id = $_GET['pdf'];

$obj = new invoice;
$data = $obj->displayInvoiceById($id);
// var_dump($data);
// var_dump($id);
$invoiceDate = $data['invoice_datetime'];
$date = date('d-m-Y', strtotime($invoiceDate));

$qty_services = 1;
$total_item_services = $qty_services * intval($data['services_price']);

$qty_domain = 1;
$total_item_domain = $qty_domain * intval($data['domain_extension']);

$qty_hosting = 1;
$total_item_hosting = $qty_hosting * intval($data['hosting_extension']);

$subtotal = $total_item_services + $total_item_domain + $total_item_hosting;

$total = $subtotal - intval($data['invoice_paid']);

$html = '
<style>
wrapper{
  width: 100%;
  font-family: arial;
}

.head-invoice {
  width: 100%;
  padding: 40px;
  background-color: #f8f7fa;
}

h1 {
  font-size: 28px;
  margin: 0;
}

h3 {
margin-bottom: 5px;
padding: 0;
}

.company-logo img {
  width: 50px;
}

.company-logo {
  width: 50%;
  float: left;
}

.invoice-code {
  width: 50%;
  float: right;
  
}

.invoice-code-detail{
  margin-left: 32px;
}

.invoice-code-detail h1,
.invoice-number {
  padding-bottom: 10px;
}

.invoice-bill {
  padding: 40px;
  width: 100%;
}

.bill-to {
  width: 50%;
  float: left;
}

span{
  display: inline-block;
}

h4{
  font-weight: 400;
  margin: 0;
}

.bill-from {
  width: 50%;
  float: right;
}

.bill-from-content {
  float: left;
  margin-left: 32px;
}

.bill-to-item {
  text-transform: capitalize;
  padding: 5px;
}

.bill-to-email{
  text-transform: lowercase;
}

table {
  width: 100%;
  padding: 40px;
  border-collapse: collapse;
}

th {
  text-align: left;
  text-transform: uppercase;
  background-color: #f8f7fa;
  padding: 20px 0 20px 0;
  font-size: 16px;
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
  border-top: 1px solid #eeeeee;
}

td{
padding: 16px 0;
}

.grey{
  background-color: #f8f7fa;
}

.text-center{
  text-align: center;
  padding-right: 60px;
}

.text-bold{
  font-weight: bold;
}

td, th{
  padding-left: 14px;
}

.paid-img{
  float: right;
  margin-right: 40px;
  margin-top: 10px;
}
</style>
  <div class="wrapper">
    <div class="head-invoice">
      <div class="company-logo">
        <img src="./dist/img/Logo.png" alt="lann_logo" width="80px">
      </div>
      <div class="invoice-code">
        <div class="invoice-code-detail">
          <h1>Invoice</h1>
          <div class="invoice-number">
            <h3>Invoice Number:</h3>
            <span>' .  $data['invoice_code'] . '</span>
          </div>
          <div class="invoice-date">
            <h3>Date</h3>
            <span>' . $date . '</span>
          </div>
        </div>
      </div>
    </div>
  </div>
';

$html .= '
<div class="invoice-bill">
  <div class="bill-to">
    <h3 class="bill-to-item">Bill To</h3>
    <h4 class="bill-to-item">' . $data['client_name'] . '</h4>
    <h4 class="bill-to-item">' . $data['company_name'] . '</h4>
    <h4 class="bill-to-item bill-to-email">' . $data['client_email'] . '</h4>
    <h4 class="bill-to-item">' . $data['client_phone'] . '</h4>
  </div>
  <div class="bill-from">
    <div class="bill-from-content">
      <h3 class="bill-to-item">Bill From</h3>
      <h4 class="bill-to-item">LANN.</h4>
      <h4 class="bill-to-item">lann@gmail.com</h4>
      <h4 class="bill-to-item">085xxxxxxxxx</h4>
      <h4 class="bill-to-item">Bali 80xxx</h4>
    </div>
  </div>
</div>
';

$html .= '
<table>
      <thead>
        <tr>
          <th width="50%">Item</th>
          <th width="20%">Cost</th>
          <th width="10%" class="text-center">Qty</th>
          <th width="20%">Price</th>
        </tr>
      </thead>
      <tbody>
        <tr class="tr-body">
          <td>' . $data['services_name'] . '</td>
          <td>Rp.' . $data['services_price'] . '</td>
          <td class="text-center">' .  $qty_services . '</td>
          <td>Rp.' . $total_item_services . '</td>
        </tr>
        <tr class="tr-body">
          <td>Domain ' . $data['domain_name'] . '</td>
          <td>Rp.' . $data['domain_extension'] . '</td>
          <td class="text-center">' . $qty_domain . '</td>
          <td>Rp.' . $total_item_domain . '</td>
        </tr>
        <tr class="tr-body">
          <td>' . $data['hosting_name'] . '</td>
          <td>Rp' . $data['hosting_extension'] . '</td>
          <td class="text-center">' . $qty_hosting . '</td>
          <td>Rp.' . $total_item_hosting . '</td>
        </tr>
        <tr class="tr-subtotal">
          <td></td>
          <td colspan="2" class="divider">Subtotal</td>
          <td class="divider">Rp.' . $subtotal . '</td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" class="text-bold">Total</td>
          <td class="text-bold">Rp.' . $subtotal . '</td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" class="divider">Paid</td>
          <td class="divider">-Rp.' . $data['invoice_paid'] . '</td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" class="grey text-bold">Amount Due</td>
          <td class="grey text-bold">Rp.' . $total . '</td>
        </tr>
      </tbody>
</table>
';

if ($data['invoice_status'] == 'paid') {
  $html .= '<img class="paid-img" src="./dist/img/paid.png" alt="paid" width="100px">';
}


$mpdf->WriteHTML($html);
$mpdf->Output();
