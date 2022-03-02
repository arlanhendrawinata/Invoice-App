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



  // $('.btn-pdf').click(function(){
  //   alert('halo');
  // })



  // function getAllVal() {
  //   var clientVal = $('#input_client').val();
  //   var domainVal = $('#input_domain').val();
  //   var servicesVal = $('#input_services').val();
  //   var hostingVal = $('#input_hosting').val();
  //   var statusVal = $('#status').val();
  //   var paidVal = $('#paid').val();
  //   var totalVal = $('#total').val();

  //   console.table(
  //     "client = " + clientVal,
  //     "domain = " + domainVal);
  // }

  // var clientVal = Number($('#input_client').val());
  // var servicesVal;
  // var domainVal;
  // var hostingVal;
  // var paidVal = Number($('#paid').val());
  // var total;
  // var status;
  // var gt;

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

  $('#reset').click(function() {
    $(this).prop('disabled', true);
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
      url: "./process/ajax/getInvoiceCode.php",
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

    // invoiceCode = Number($('#invoice_code').val());

    // inputServices = $('#input_services').val();
    // inputDomain = $('#input_domain').val();
    // inputHosting = $('#input_hosting').val();

    servicesVal = Number($('#service_price').val());
    domainVal = Number($('#domain_extension').val());
    hostingVal = Number($('#hosting_extension').val());

    total = Number($('#total').val());
    paidVal = Number($('#paid').val());

    clientVal = Number($('#input_client').val());

    invoice_status = $('#invoice_status').val();

    gt = servicesVal + domainVal + hostingVal;
    $("#grand_total").val(gt);

    if (Number($("#total").val()) == 0) {
      total = gt;

      $("#total").val(total);
      // console.log($('#total').val());
    } else {
      total = gt - paidVal;
      $("#total").val(total);
      if (total == 0){
        $('#invoice_status').val('paid'); 
        // $("#total").val(total);
      } else{
        $('#invoice_status').val('unpaid');
      }
    }
  }

  // $('#invoice_submit').click(function(e) {
  //   e.preventDefault();
  //   alert('submit');
  // });

  $('#invoice_submit').click(function() {
    $(this).prop('disabled', true)
    // calculateInvoice();

    // console.log(
    //   'invoice code = ' + invoiceCode,
    //   'client = ' + clientVal,
    //   'services = ' + inputServices,
    //   'domain = ' + inputDomain,
    //   'hosting = ' + inputHosting,
    //   'grandtotal = ' + gt,
    //   'paid = ' + paidVal,
    //   'total = ' + total,
    //   'status = ' + status
    // );

    // $('.tes2').html($('#invoice_form').serialize());

    addDataInvoice();
    //  invoiceCode = Number($('#invoice_code').val());

  });

  // calculateTotal(gt);
  // function calculateTotal(paidVal, gTot) {
  //   var total = gTot - paidVal;
  //   $("#total").val(total);
  // }

  // get data services 
  function getDataServices(idServices) {
    $.ajax({
      type: "POST",
      url: "./process/ajax/getDataServices.php",
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
      url: "./process/ajax/getDataDomain.php",
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
      url: "./process/ajax/getDataHosting.php",
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
      url: "./process/ajax/addDataInvoice.php",
      data: $('#invoice_form').serialize(),
      dataType: "JSON",
      success: function(response) {
        // console.log(response);
        $('.tes').html(response);
        $('#main-content').load('./invoice.php');

      }
    });
  }