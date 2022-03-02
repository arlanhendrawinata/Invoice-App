<?php

include './process/process.php';

$obj = new hosting;
$datas = $obj->displayHosting();

?>
<div class="head-content" id="hosting_section">
  <div class="message"></div>
  <form action="" method="post" id="hosting_form">
    <input type="number" name="hosting_id" id="hosting_id" hidden>
    <div class="finput finput-name">
      <label for="hosting_name">Hosting Name</label>
      <input type="text" name="hosting_name" id="hosting_name" placeholder="Enter hosting name" />
    </div>
    <div class="finput finput-annual">
      <label for="hosting_annual">Hosting Annual</label>
      <input type="number" name="hosting_annual" id="hosting_annual" />
    </div>
    <div class="finput finput-extension">
      <label for="hosting_extension">Hosting Extension</label>
      <input type="number" name="hosting_extension" id="hosting_extension" />
    </div>
    <div class="list-btn">
      <div class="finput finput-button-submit">
        <button type="submit" class="btn-action" name="hosting_submit" id="hosting_submit">Submit</button>
      </div>
      <div class="finput finput-button-reset">
        <button class="btn-action" id="reset">Reset</button>
      </div>
      <div class="finput finput-button-update hide">
        <button class="btn-action" type="submit" name="hosting_update" id="hosting_update">Update</button>
      </div>
      <div class="finput finput-button-cancel hide">
        <button class="btn-action" id="hosting_cancel">Cancel</button>
      </div>
    </div>
  </form>
</div>
<div class="table-content">
  <table>
    <thead>
      <tr>
        <th>Hosting Name</th>
        <th>Hosting Annual</th>
        <th>Hosting Extension</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (is_array($datas)) {
        foreach ($datas as $data) {
      ?>
          <tr>
            <td><?= $data['hosting_name']; ?></td>
            <td><?= $data['hosting_annual']; ?></td>
            <td><?= $data['hosting_extension']; ?></td>
            <td class="td-action">
              <a class="btn-update btn-action" onclick="getHostingById(<?= $data['hosting_id'] ?>)">Update</a>
              <a class="btn-delete btn-action" onclick="deleteDataHosting(<?= $data['hosting_id'] ?>)">Delete</a>
            </td>
          </tr>
      <?php }
      } ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#hosting_annual').val(0);
    $('#hosting_extension').val(0);
  });
  // fetch data hosting by id
  function getHostingById(id) {
    $('.finput-button-reset').addClass('hide');
    $('.finput-button-submit').addClass('hide');
    $('.finput-button-update').removeClass('hide');
    $('.finput-button-cancel').removeClass('hide');
    alert("Update data id = " + id);
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxHosting/getHostingById.php",
      data: "id=" + id,
      dataType: "JSON",
      success: function(response) {
        console.log(response);
        updateValue(response);
        $('#hosting_id').val(response.hosting_id);
      }
    });
  }

  // function to update value
  function updateValue(response) {
    $('#hosting_name').val(response.hosting_name);
    $('#hosting_extension').val(response.hosting_extension);
    $('#hosting_annual').val(response.hosting_annual);
  }
  // after click cancel button load hosting.php file
  $('#hosting_cancel').click(function(e) {
    e.preventDefault();
    $('#main-content').load('http://localhost/lann_invoice_app/hosting.php');
  });

  // reset the value on hosting form
  $('#reset').click(function(e) {
    e.preventDefault();
    $('#hosting_name').val('');
    $('#hosting_annual').val(0);
    $('#hosting_extension').val(0);
  });

  $('#hosting_submit').click(function(e) {
    e.preventDefault();

    // add data hosting
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxHosting/addHosting.php",
      data: $('#hosting_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        alert(response);
        $('#main-content').load('http://localhost/lann_invoice_app/hosting.php');
      }
    });
  });

  $('#hosting_update').click(function(e) {
    e.preventDefault();

    // update data hosting
    $.ajax({
      type: "POST",
      url: "http://localhost/lann_invoice_app/process/ajaxHosting/updateHosting.php",
      data: $('#hosting_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        alert(response);
        $('#main-content').load('http://localhost/lann_invoice_app/hosting.php');
      }
    });
  });

  // delete data hosting
  function deleteDataHosting(id) {
    const confirmAction = confirm("Are you sure to delete this data id = " + id + " ?");
    if (confirmAction) {
      $.ajax({
        type: "POST",
        url: "http://localhost/lann_invoice_app/process/ajaxHosting/deleteHosting.php",
        data: "id=" + id,
        dataType: "JSON",
        success: function(response) {
          alert(response);
          $('#main-content').load('http://localhost/lann_invoice_app/hosting.php');
        }
      });
    } else {
      alert('Delete data has been canceled');
    }
  }
</script>