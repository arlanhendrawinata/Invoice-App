<?php

include './process/process.php';

$obj = new domain;
$datas = $obj->displayDomain();

?>
<div class="head-content" id="domain_section">
  <div class="message"></div>
  <form action="" method="post" id="domain_form">
    <input type="number" name="domain_id" id="domain_id" hidden>
    <div class="finput finput-name">
      <label for="domain_name">Domain Name</label>
      <input type="text" name="domain_name" id="domain_name" placeholder="Enter domain name" />
    </div>
    <div class="finput finput-annual">
      <label for="domain_annual">Domain Annual</label>
      <input type="number" name="domain_annual" id="domain_annual" />
    </div>
    <div class="finput finput-extension">
      <label for="domain_extension">Domain Extension</label>
      <input type="number" name="domain_extension" id="domain_extension" />
    </div>
    <div class="list-btn">
      <div class="finput finput-button-submit">
        <button type="submit" class="btn-action" name="domain_submit" id="domain_submit">Submit</button>
      </div>
      <div class="finput finput-button-reset">
        <button class="btn-action" id="reset">Reset</button>
      </div>
      <div class="finput finput-button-update hide">
        <button class="btn-action" type="submit" name="domain_update" id="domain_update">Update</button>
      </div>
      <div class="finput finput-button-cancel hide">
        <button class="btn-action" id="domain_cancel">Cancel</button>
      </div>
    </div>
  </form>
</div>
<div class="table-content">
  <table>
    <thead>
      <tr>
        <th>Domain Name</th>
        <th>Domain Annual</th>
        <th>Domain Extension</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (is_array($datas)) {
        foreach ($datas as $data) {
      ?>
          <tr>
            <td><?= $data['domain_name']; ?></td>
            <td><?= $data['domain_annual']; ?></td>
            <td><?= $data['domain_extension']; ?></td>
            <td class="td-action">
              <a class="btn-update btn-action" onclick="getDomainById(<?= $data['domain_id'] ?>)">Update</a>
              <a class="btn-delete btn-action" onclick="deleteDataDomain(<?= $data['domain_id'] ?>)">Delete</a>
            </td>
          </tr>
      <?php }
      } ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#domain_annual').val(0);
    $('#domain_extension').val(0);
  });
  // fetch data domain by id
  function getDomainById(id) {
    $('.finput-button-reset').addClass('hide');
    $('.finput-button-submit').addClass('hide');
    $('.finput-button-update').removeClass('hide');
    $('.finput-button-cancel').removeClass('hide');
    alert("Update data id = " + id);
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxDomain/getDomainById.php",
      data: "id=" + id,
      dataType: "JSON",
      success: function(response) {
        console.log(response);
        updateValue(response);
        $('#domain_id').val(response.domain_id);
      }
    });
  }

  // function to update value
  function updateValue(response) {
    $('#domain_name').val(response.domain_name);
    $('#domain_extension').val(response.domain_extension);
    $('#domain_annual').val(response.domain_annual);
  }

  // after click cancel button load domain.php file
  $('#domain_cancel').click(function(e) {
    e.preventDefault();
    $('#main-content').load('http://localhost/lann_invoice_app/domain.php');
  });

  // reset the value on domain form
  $('#reset').click(function(e) {
    e.preventDefault();
    $('#domain_name').val('');
    $('#domain_annual').val(0);
    $('#domain_extension').val(0);
  });

  $('#domain_submit').click(function(e) {
    e.preventDefault();

    // add data domain
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxDomain/addDomain.php",
      data: $('#domain_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        alert(response);
        $('#main-content').load('http://localhost/lann_invoice_app/domain.php');
      }
    });
  });

  $('#domain_update').click(function(e) {
    e.preventDefault();

    // update data domain
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxDomain/updateDomain.php",
      data: $('#domain_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        alert(response);
        $('#main-content').load('http://localhost/lann_invoice_app/domain.php');
      }
    });
  });

  // delete data domain
  function deleteDataDomain(id) {
    const confirmAction = confirm("Are you sure to delete this data id = " + id + " ?");
    if (confirmAction) {
      $.ajax({
        type: "POST",
        url: "http://localhost/lann_invoice_app/process/ajaxDomain/deleteDomain.php",
        data: "id=" + id,
        dataType: "JSON",
        success: function(response) {
          alert(response);
          $('#main-content').load('http://localhost/lann_invoice_app/domain.php');
        }
      });
    } else {
      alert('Delete data has been canceled');
    }
  }
</script>