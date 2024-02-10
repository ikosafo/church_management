<?php
    /* db connection */
    include ('config.php');
    include ('functions.php');

    $username = $_SESSION['username'];

    if (!isset($_SESSION['username'])) {
        header("location:login");
    }

    else {

      /* Check whether system configuration has been filled  */
    $getsystemconfig = $mysqli->query("select * from system_config");
    $getcount = mysqli_num_rows($getsystemconfig);

    //redirect if it has not
    if ($getcount == "0") {
      if ($_SERVER['REQUEST_URI'] == "/systemconfig") {
        echo "";
      }
      else {
        header("location:systemconfig");
      }
    }
    else {
      echo "";
    }

    }

    $newsaleid = unlock($_GET['newsaleid']);

    //Get invoice ID
    $getsale = $mysqli->query("select * from sales where newsaleid = '$newsaleid'");
    $ressale = $getsale->fetch_assoc();
    $salesid= $ressale['salesid'];
    $customerid = $ressale['customerid'];
    $date = substr($ressale['datetime'],0,10);
    $length = 5;
    $string = substr(str_repeat(0, $length).$salesid, - $length);
    $invoiceid = $string.''.date('y');
?>


<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Point of Sale System</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.html">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo getLogo(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-wizard.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/dashboard-ecommerce.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/charts/chart-apex.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/ext-component-toastr.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/uploadifive/uploadifive.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/jquery-confirm.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

    <script>
       
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

       function isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
              return false;
          }
          return true;
        }
      
    </script>

  
  </head>
  <!-- END: Head-->


<body onload="window.print()">
<div class="content-body">
  
<div class="invoice-print p-3">
  <div class="invoice-header d-flex justify-content-between flex-md-row flex-column pb-2">
    <div>
      <div class="d-flex mb-1">
       <img src="<?php echo getLogo(); ?>" style="width:5%"/>
      </div>
      <p class="mb-25"><?php echo getCompanyName(); ?></p>
      <p class="mb-25"><?php echo getCompanyTagline(); ?></p>
      <p class="mb-25"><?php echo getCompanyAddress(); ?></p>
      <p class="mb-0">Tel: <?php echo getCompanyTelephone(); ?></p>
    </div>
    <div class="mt-md-0 mt-2">
      <h4 class="fw-bold text-end mb-1">INVOICE #: <?php echo $invoiceid; ?></h4>
      <div class="invoice-date-wrapper mb-50">
        <span class="invoice-date-title">Date Issued:</span>
        <span class="fw-bold"> <?php echo $date; ?></span>
      </div>
      <h6 class="mb-1">Invoice To:</h6>
      <p class="mb-25"><?php echo getCustomerName($customerid); ?></p>
    </div>
  </div>
  <?php
  //Get items sold
  $getitems = $mysqli->query("select * from tempsales where genid = '$newsaleid'");
  ?>
 
  <div class="table-responsive mt-2">
    <table class="table m-0">
      <thead>
        <tr>
          <th class="py-1">Product</th>
          <th class="py-1">Quantity</th>
          <th class="py-1">Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
       while ($resitems = $getitems->fetch_assoc()) { ?>
        <tr>
          <td class="py-1">
              <?php echo getProductName($resitems['prodid']); ?>
          </td>
          <td class="py-1">
              <?php echo $resitems['quantity']; ?>
          </td>
          <td class="py-1">
              <?php echo $resitems['price']; ?>
          </td>
        </tr>
       <?php } 
        ?>
      </tbody>
    </table>
  </div>

  <div class="row invoice-sales-total-wrapper mt-3">
    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
      <p class="card-text mb-0"><span class="fw-bold">Salesperson:</span> 
          <span class="ms-75"><?php echo getLogname($ressale['username']); ?></span></p>
    </div>
    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
      <div class="invoice-total-wrapper">
        <div class="invoice-total-item">
          <p class="invoice-total-title">Subtotal: <?php echo $ressale['totalprice']; ?></p>
        </div>
        <div class="invoice-total-item">
          <p class="invoice-total-title">Discount:0.00</p>
        </div>
        <div class="invoice-total-item">
          <p class="invoice-total-title">Tax:0.00</p>
        </div>
        <hr class="my-50">
        <div class="invoice-total-item">
          <p class="invoice-total-title">Total: <strong><?php echo $ressale['totalprice']; ?></strong></p>
        </div>
      </div>
    </div>
  </div>

 
</div>

        </div>

       </body>

       </html>