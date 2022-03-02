<?php

include './process/process.php';

$obj = new client;
$datas = $obj->displayClient();

?>
<div class="head-content" id="client_section">
  <div class="message"></div>
  <form action="" method="post" id="client_form">
    <input type="number" name="client_id" id="client_id" hidden>
    <div class="finput finput-company">
      <label for="company">Company</label>
      <input type="text" name="company" id="company" placeholder="Enter your company name" />
    </div>
    <div class="finput finput-name">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" placeholder="Enter your name" />
    </div>
    <div class="finput finput-email">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Enter your email" />
    </div>
    <div class="finput finput-phone">
      <label for="phone">Phone</label>
      <input type="number" name="phone" id="phone" placeholder="Enter your phone number" />
    </div>
    <div class="list-btn">
      <div class="finput finput-button-submit">
        <button type="submit" class="btn-action" name="client_submit" id="client_submit">Submit</button>
      </div>
      <div class="finput finput-button-reset">
        <button class="btn-action" id="reset">Reset</button>
      </div>
      <div class="finput finput-button-update hide">
        <button class="btn-action" type="submit" name="client_update" id="client_update">Update</button>
      </div>
      <div class="finput finput-button-cancel hide">
        <button class="btn-action" id="client_cancel">Cancel</button>
      </div>
    </div>
  </form>
</div>
<div class="table-content">
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Company</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (is_array($datas)) {
        foreach ($datas as $data) {
      ?>
          <tr>
            <td><?= $data['client_id']; ?></td>
            <td><?= $data['company_name']; ?></td>
            <td><?= $data['client_name']; ?></td>
            <td><?= $data['client_email']; ?></td>
            <td><?= $data['client_phone']; ?></td>
            <td class="td-action">
              <a class="btn-update btn-action" onclick="getClientById(<?= $data['client_id'] ?>)">Update</a>
              <a class="btn-delete btn-action" onclick="deleteDataClient(<?= $data['client_id'] ?>)">Delete</a>
            </td>
          </tr>
      <?php }
      } ?>
    </tbody>
  </table>
</div>

<script>
  // fetch data client by id
  function getClientById(id) {
    $('.finput-button-reset').addClass('hide');
    $('.finput-button-submit').addClass('hide');
    $('.finput-button-update').removeClass('hide');
    $('.finput-button-cancel').removeClass('hide');
    alert("Update data id = " + id);
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxClient/getClientById.php",
      data: "id=" + id,
      dataType: "JSON",
      success: function(response) {
        console.log(response);
        updateValue(response);
        $('#client_id').val(response.client_id);
      }
    });
  }

  // function to update value
  function updateValue(response) {
    $('#company').val(response.company_name);
    $('#name').val(response.client_name);
    $('#phone').val(response.client_phone);
    $('#email').val(response.client_email);
  }
  // after click cancel button load client.php file
  $('#client_cancel').click(function(e) {
    e.preventDefault();
    $('#main-content').load('http://localhost/lann_invoice_app/client.php');
  });

  // reset the value on client form
  $('#reset').click(function(e) {
    e.preventDefault();
    $('#company').val('');
    $('#name').val('');
    $('#phone').val('');
    $('#email').val('');
  });

  $('#client_submit').click(function(e) {
    e.preventDefault();

    // add data client
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxClient/addClient.php",
      data: $('#client_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        alert(response);
        $('#main-content').load('http://localhost/lann_invoice_app/client.php');
      }
    });
  });

  $('#client_update').click(function(e) {
    e.preventDefault();

    // update data client
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxClient/updateClient.php",
      data: $('#client_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        alert(response);
        $('#main-content').load('http://localhost/lann_invoice_app/client.php');
      }
    });
  });

  // delete data client
  function deleteDataClient(id) {
    const confirmAction = confirm("Are you sure to delete this data id = " + id + " ?");
    if (confirmAction) {
      $.ajax({
        type: "POST",
        url: "http://localhost/lann_invoice_app/process/ajaxClient/deleteClient.php",
        data: "id=" + id,
        dataType: "JSON",
        success: function(response) {
          alert(response);
          $('#main-content').load('http://localhost/lann_invoice_app/client.php');
        }
      });
    } else {
      alert('Delete data has been canceled');
    }
  }
</script>