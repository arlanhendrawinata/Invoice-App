<?php

include './process/process.php';

$obj = new invoice;
$datasInvoice = $obj->displayInvoice();
$objDomain = new domain;
$datasDomain = $objDomain->displayDomain();
$objHosting = new hosting;
$datasHosting = $objHosting->displayHosting();
$objServices = new services;
$datasServices = $objServices->displayServices();

?>

<div class="alert-section"></div>

<div class="head-content" id="invoice_section">
  <form action="" method="post" id="invoice_form">
    <div class="finput finput-invoice_code">
      <label for="invoice_code">Invoice Code</label>
      <input type="text" name="invoice_code" id="invoice_code" />
    </div>
    <div class="finput finput-client">
      <label for="client">Client ID</label>
      <input type="number" name="client" id="input_client" />
    </div>
    <div class="finput finput-service">
      <label for="service">Services</label>
      <select name="service" id="input_services">
        <option value="0" selected disabled>Select services...</option>
        <?php
        if (is_array($datasServices)) {
          foreach ($datasServices as $dataServices) { ?>
            <option value="<?= $dataServices['services_id'] ?>">
              <?= $dataServices['services_name'] ?>
            </option>
        <?php }
        } ?>
      </select>
      <input type="number" name="service_price" id="service_price" hidden disabled />
    </div>
    <div class="finput finput-domain">
      <label for="domain">Domain</label>
      <select name="domain" id="input_domain">
        <option value="0" selected disabled>Select domain...</option>
        <?php
        if (is_array($datasDomain)) {
          foreach ($datasDomain as $dataDomain) { ?>
            <option value="<?= $dataDomain['domain_id'] ?>">
              <?= $dataDomain['domain_name'] ?>
            </option>
        <?php }
        } ?>
      </select>
      <input type="number" name="domain_extension" id="domain_extension" hidden disabled />
    </div>
    <div class="finput finput-hosting">
      <label for="hosting">Hosting</label>
      <select name="hosting" id="input_hosting">
        <option value="0" selected disabled>Select hosting...</option>
        <?php
        if (is_array($datasHosting)) {
          foreach ($datasHosting as $dataHosting) { ?>
            <option value="<?= $dataHosting['hosting_id'] ?>">
              <?= $dataHosting['hosting_name'] ?>
            </option>
        <?php }
        } ?>
      </select>
      <input type="number" name="hosting_extension" id="hosting_extension" hidden disabled />
    </div>
    <div class="finput finput-grand-total">
      <label for="grand-total">Grand Total</label>
      <input type="number" name="grand-total" id="grand_total" disabled />
    </div>
    <div class="finput finput-paid">
      <label for="paid">Paid</label>
      <input type="number" name="paid" id="paid" value="0" />
    </div>
    <div class="finput finput-total">
      <label for="total">Total</label>
      <input type="number" name="total" id="total" />
    </div>
    <div class="finput finput-status">
      <label for="invoice_status">Status</label>
      <select name="invoice_status" id="invoice_status">
        <option value="unpaid">Unpaid</option>
        <option value="paid">Paid</option>
      </select>
    </div>
    <div class="finput finput-button-submit">
      <button class="btn-action" type="submit" name="invoice_submit" id="invoice_submit">Submit</button>
    </div>
    <div class="finput finput-button-reset">
      <button class="btn-action" id="reset">Reset</button>
    </div>
    <div class="finput finput-button-update hide">
      <button class="btn-action" type="submit" name="invoice_update" id="invoice_update">Update</button>
    </div>
    <div class="finput finput-button-cancel hide">
      <button class="btn-action" id="invoice_cancel">Cancel</button>
    </div>
  </form>
</div>
<div class="table-content">
  <table>
    <thead>
      <tr>
        <th>Invoice Code</th>
        <th>Company</th>
        <th>Full Name</th>
        <th>Services</th>
        <th>Domain</th>
        <th>Hosting</th>
        <th>Paid</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date Time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody class="show-data">
      <?php
      if (is_array($datasInvoice)) {
        foreach ($datasInvoice as $dataInvoice) { ?>
          <tr>
            <td class='td-invoice-code'><?= $dataInvoice['invoice_code'] ?></td>
            <td class='td-company'><?= $dataInvoice['company_name'] ?></td>
            <td class='td-name'><?= $dataInvoice['client_name'] ?></td>
            <td class='td-services'><?= $dataInvoice['services_name'] ?></td>
            <td class='td-domain'><?= $dataInvoice['domain_name'] ?></td>
            <td class='td-hosting'><?= $dataInvoice['hosting_name'] ?></td>
            <td class='td-paid'><?= $dataInvoice['invoice_paid'] ?></td>
            <td class='td-total'><?= $dataInvoice['invoice_total'] ?></td>
            <td class='td-status'><?= $dataInvoice['invoice_status'] ?></td>
            <td class='td-datetime'><?= $dataInvoice['invoice_datetime'] ?></td>
            <td class='td-action'>
              <a class="btn-pdf btn-action" href="http://localhost/lann_invoice_app/pdf.php?pdf=<?= $dataInvoice['invoice_id'] ?>" target="_blank">PDF</a>
              <a class="btn-update btn-action" onclick="getInvoiceById(<?= $dataInvoice['invoice_id'] ?>)">Update</a>
              <a class="btn-delete btn-action" onclick="deleteDataInvoice(<?= $dataInvoice['invoice_id'] ?>)">Delete</a>
            </td>
          </tr>
      <?php }
      } ?>
    </tbody>
  </table>
</div>

<script>
  var invoiceCode;

  var inputServices;
  var inputDomain;
  var inputHosting;

  var servicesVal;
  var domainVal;
  var hostingVal;

  var total;
  var paidVal;

  var invoice_status;
  var clientVal;
  var gt;
  var total;

  $(document).ready(function() {
    setToZero();
    // getAllVal();
    getInvoiceCode();
  });

  // $('.btn-pdf').click(function(e) {
  //   // e.preventDefault();
  //   alert($(this).attr('id'));
  // });

  function getInvoiceById(id) {
    // e.preventDefault();
    // alert($(this).attr('id'));
    $('.finput-button-reset').addClass('hide');
    $('.finput-button-submit').addClass('hide');
    $('.finput-button-update').removeClass('hide');
    $('.finput-button-cancel').removeClass('hide');

    // var idUpdate = $(this).attr('id');
    alert("Update data id = " + id);

    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajax/getInvoiceById.php",
      data: "idUpdate=" + id,
      dataType: "JSON",
      success: function(response) {
        $('#invoice_code').val(response.invoice_code);
        $('#input_client').val(response.client_id);
        $('#input_services').val(response.services_id);
        $('#service_price').val(response.services_price);
        $('#input_domain').val(response.domain_id);
        $('#domain_extension').val(response.domain_extension);
        $('#input_hosting').val(response.hosting_id);
        $('#hosting_extension').val(response.hosting_extension);
        $('#paid').val(response.invoice_paid);
        $('#invoice_status').val(response.invoice_status);
        $('#total').val(response.invoice_total);
        calculateInvoice();
      }
    });
  };

  $('#invoice_update').click(function(e) {
    e.preventDefault();
    $('.tes2').html($('#invoice_form').serialize());
    updateDataInvoice();
  });

  $('#invoice_cancel').click(function(e) {
    e.preventDefault();
    $('#main-content').load('http://localhost/lann_invoice_app/invoice.php');
  });

  $('#input_client').change(function() {
    // clientVal = Number($('#input_client').val());
    // addToInvoice(clientVal);
    calculateInvoice();
  });

  // paid input
  $("#paid").keyup(function() {
    // paidVal = Number($('#paid').val());
    // console.log(paidVal);
    calculateInvoice();
  });

  // status change
  $("#invoice_status").change(function() {
    // status = $('#status').val();
    // console.log(paidVal);
    calculateInvoice();
  });

  // services input
  $("#input_services").change(function() {
    getDataServices($(this).val());
  });

  // domain input
  $("#input_domain").change(function() {
    getDataDomain($(this).val());
  });

  // hosting input
  $("#input_hosting").change(function() {
    getDataHosting($(this).val());
  });

  $('#reset').click(function(e) {
    e.preventDefault();
    setToZero();
    $('#input_client').val("");
    $('#input_domain').val(0).attr('checked');
    $('#input_hosting').val(0).attr('checked');
    $('#input_services').val(0).attr('checked');
  });

  function setToZero() {
    $('#service_price').val(0);
    $('#domain_extension').val(0);
    $('#hosting_extension').val(0);
    $('#grand_total').val(0);
    $('#paid').val(0);
    $('#total').val(0);
    $('#invoice_status').val('unpaid');
  }

  function getInvoiceCode() {
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajax/getInvoiceCode.php",
      dataType: "JSON",
      success: function(response) {
        // console.log(response);
        $('#invoice_code').val(response);
        // calculateInvoice();
      }
    });
  }

  // calculation function
  function calculateInvoice() {
    servicesVal = Number($('#service_price').val());
    domainVal = Number($('#domain_extension').val());
    hostingVal = Number($('#hosting_extension').val());
    total = Number($('#total').val());
    paidVal = Number($('#paid').val());
    clientVal = Number($('#input_client').val());
    invoice_status = $('#invoice_status').val();

    gt = servicesVal + domainVal + hostingVal;
    $("#grand_total").val(gt);

    total = gt - paidVal;
    $("#total").val(total);
    if (total == 0) {
      $('#invoice_status').val('paid');
    } else {
      $('#invoice_status').val('unpaid');
    }
  }

  $('#invoice_submit').click(function(e) {
    e.preventDefault();
    addDataInvoice();
  });

  // get data services 
  function getDataServices(idServices) {
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajax/getDataServices.php",
      data: "idServices=" + idServices,
      dataType: "JSON",
      success: function(response) {
        // console.log(response);
        $('#service_price').val(response.services_price);
        calculateInvoice();
      }
    });
  }

  // get data domain
  function getDataDomain(idDomain) {
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajax/getDataDomain.php",
      data: "idDomain=" + idDomain,
      dataType: "JSON",
      success: function(response) {
        // console.log(response);
        $('#domain_extension').val(response.domain_extension);
        calculateInvoice();
      }
    });
  }

  // get data hosting
  function getDataHosting(idHosting) {
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajax/getDataHosting.php",
      data: "idHosting=" + idHosting,
      dataType: "JSON",
      success: function(response) {
        $('#hosting_extension').val(response.hosting_extension);
        calculateInvoice();
      }
    });
  }

  function addDataInvoice() {
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajax/addDataInvoice.php",
      data: $('#invoice_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        // console.log(response);
        $('.tes').html(response);
        $('#main-content').load('http://localhost/lann_invoice_app/invoice.php');

      }
    });
  }

  function updateDataInvoice() {
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajax/updateInvoice.php",
      data: $('#invoice_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        // console.log(response);
        // $('.tes').html(response);
        alert(response);
        $('#main-content').load('http://localhost/lann_invoice_app/invoice.php');
      }
    });
  }

  function deleteDataInvoice(id) {
    const confirmAction = confirm("Are you sure to delete this data id = " + id + " ?");
    if (confirmAction) {
      $.ajax({
        type: "POST",
        url: "http://localhost/lann_invoice_app/process/ajax/deleteInvoice.php",
        data: "deleteId=" + id,
        dataType: "JSON",
        success: function(response) {
          alert(response);
          $('#main-content').load('http://localhost/lann_invoice_app/invoice.php');
        }
      });
    } else {
      alert('Delete data has been canceled');
    }
  }
</script>