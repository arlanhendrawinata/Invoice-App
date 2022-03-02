$(document).ready(function () {
  $('#main-content').load('http://localhost/lann_invoice_app/client.php');
  $('.menu-client').addClass('active');
});

$('.menu').click(function (e) {
  e.preventDefault();
  var menu = $(this).attr('id');
  if (menu == 'client'){
    $('.menu').removeClass('active');
    $('.menu-client').addClass('active');
    $('#main-content').load('http://localhost/lann_invoice_app/client.php');
  } else if (menu == 'domain'){
      $('.menu').removeClass('active');
      $('.menu-domain').addClass('active');
      $('#main-content').load('http://localhost/lann_invoice_app/domain.php');
  } else if (menu == 'hosting'){
      $('.menu').removeClass('active');
      $('.menu-hosting').addClass('active');
      $('#main-content').load('http://localhost/lann_invoice_app/hosting.php');
  } else if (menu == 'services'){
      $('.menu').removeClass('active');
      $('.menu-services').addClass('active');
      $('#main-content').load('http://localhost/lann_invoice_app/services.php');
  } else if (menu == 'category'){
      $('.menu').removeClass('active');
      $('.menu-category').addClass('active');
      $('#main-content').load('http://localhost/lann_invoice_app/category.php');
  } else if (menu == 'invoice'){
      $('.menu').removeClass('active');
      $('.menu-invoice').addClass('active');
      $('#main-content').load('http://localhost/lann_invoice_app/invoice.php');
  }
});