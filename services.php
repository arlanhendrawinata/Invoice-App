<?php

include './process/process.php';

$obj = new services;
$datas = $obj->displayServices();

?>
<div class="head-content" id="services_section">
  <div class="message"></div>
  <form action="" method="post" id="services_form">
    <input type="number" name="services_id" id="services_id" hidden>
    <div class="finput finput-name">
      <label for="services_name">Services Name</label>
      <input type="text" name="services_name" id="services_name" placeholder="Enter services name" />
    </div>
    <div class="finput finput-price">
      <label for="services_price">Services Price</label>
      <input type="number" name="services_price" id="services_price" />
    </div>
    <div class="list-btn">
      <div class="finput finput-button-submit">
        <button type="submit" class="btn-action" name="services_submit" id="services_submit">Submit</button>
      </div>
      <div class="finput finput-button-reset">
        <button class="btn-action" id="reset">Reset</button>
      </div>
      <div class="finput finput-button-update hide">
        <button class="btn-action" type="submit" name="services_update" id="services_update">Update</button>
      </div>
      <div class="finput finput-button-cancel hide">
        <button class="btn-action" id="services_cancel">Cancel</button>
      </div>
    </div>
  </form>
</div>
<div class="table-content">
  <table>
    <thead>
      <tr>
        <th>Services Name</th>
        <th>Services Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (is_array($datas)) {
        foreach ($datas as $data) {
      ?>
          <tr>
            <td><?= $data['services_name']; ?></td>
            <td><?= $data['services_price']; ?></td>
            <td class="td-action">
              <a class="btn-update btn-action" onclick="getServicesById(<?= $data['services_id'] ?>)">Update</a>
              <a class="btn-delete btn-action" onclick="deleteDataServices(<?= $data['services_id'] ?>)">Delete</a>
            </td>
          </tr>
      <?php }
      } ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#services_price').val(0);
  });

  // fetch data services by id
  function getServicesById(id) {
    $('.finput-button-reset').addClass('hide');
    $('.finput-button-submit').addClass('hide');
    $('.finput-button-update').removeClass('hide');
    $('.finput-button-cancel').removeClass('hide');
    alert("Update data id = " + id);
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxServices/getServicesById.php",
      data: "id=" + id,
      dataType: "JSON",
      success: function(response) {
        console.log(response);
        updateValue(response);
        $('#services_id').val(response.services_id);
      }
    });
  }

  // function to update value
  function updateValue(response) {
    $('#services_name').val(response.services_name);
    $('#services_price').val(response.services_price);
  }
  // after click cancel button load services.php file
  $('#services_cancel').click(function(e) {
    e.preventDefault();
    $('#main-content').load('http://localhost/lann_invoice_app/services.php');
  });

  // reset the value on services form
  $('#reset').click(function(e) {
    e.preventDefault();
    $('#services_name').val('');
    $('#services_price').val(0);
  });

  $('#services_submit').click(function(e) {
    e.preventDefault();

    // add data services
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxServices/addServices.php",
      data: $('#services_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        alert(response);
        $('#main-content').load('http://localhost/lann_invoice_app/services.php');
      }
    });
  });

  $('#services_update').click(function(e) {
    e.preventDefault();

    // update data services
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxServices/updateServices.php",
      data: $('#services_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        alert(response);
        $('#main-content').load('http://localhost/lann_invoice_app/services.php');
      }
    });
  });

  // delete data services
  function deleteDataServices(id) {
    const confirmAction = confirm("Are you sure to delete this data id = " + id + " ?");
    if (confirmAction) {
      $.ajax({
        type: "POST",
        url: "http://localhost/lann_invoice_app/process/ajaxServices/deleteServices.php",
        data: "id=" + id,
        dataType: "JSON",
        success: function(response) {
          alert(response);
          $('#main-content').load('http://localhost/lann_invoice_app/services.php');
        }
      });
    } else {
      alert('Delete data has been canceled');
    }
  }
</script>