<?php
/* db connection */
include('config.php');

@$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
  header("location:login");
} else {

  //Check whether system configuration has been filled
  $getsystemconfig = $mysqli->query("select * from system_config");
  $getcount = mysqli_num_rows($getsystemconfig);

  //redirect if it has not
  if ($getcount == "0") {
    if ($_SERVER['REQUEST_URI'] == "/systemconfig") {
      echo "";
    } else {
      header("location:systemconfig");
    }
  } else {
    echo "";
  }
}


//set timeout period in seconds
$inactive = 3600; //after 3600 seconds the user gets logged out
//check to see if $_SESSION['timeout'] is set
if (isset($_SESSION['timeout'])) {
  $session_life = time() - $_SESSION['timeout'];
  if ($session_life > $inactive) {
    session_destroy();
    header("location:login");
  }
}
$_SESSION['timeout'] = time();


function getCompNameHeader($text)
{
  $words = explode(' ', $text);
  $newSentence = '';

  foreach ($words as $index => $word) {
    $newSentence .= $word;
    if (($index + 1) % 2 === 0 && $index !== count($words) - 1) {
      $newSentence .= '<br>';
    } else {
      $newSentence .= ' ';
    }
  }
  echo $newSentence;
}

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
    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
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

  <style>
    td:nth-child(3),
    td:nth-child(4),
    td:nth-child(5),
    td:nth-child(6),
    td:nth-child(7),
    th:nth-child(3),
    th:nth-child(4),
    th:nth-child(5),
    th:nth-child(6),
    th:nth-child(7) {
      text-align: center;
    }

    td:first-child {
      text-transform: capitalize;
    }

    .dt-buttons {
      margin-bottom: 10px;
    }
  </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">

  <!-- BEGIN: Header-->
  <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
          <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
        </ul>
        <?php
        // Get Permissions

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'Add and View Sales'");
        if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>
          <ul class="nav navbar-nav bookmark-icons">
            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="addsale" data-bs-toggle="tooltip" data-bs-placement="bottom" title="New Sale">
                <i class="ficon" data-feather="shopping-cart"></i></a>
            </li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="closeday" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Close for the day">
                <i class="ficon" data-feather="log-out"></i></a>
            </li>
          </ul>
        <?php } ?>
      </div>
      <ul class="nav navbar-nav align-items-center ms-auto">

        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
        <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
          <div class="search-input">
            <div class="search-input-icon"><i data-feather="search"></i></div>
            <input class="form-control input" type="text" placeholder="Search ..." tabindex="-1" data-search="search">
            <div class="search-input-close"><i data-feather="x"></i></div>
            <ul class="search-list search-list-main"></ul>
          </div>
        </li>


        <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">
                🎉 Welcome <span style="text-transform: uppercase;"><?php echo $username; ?></span>
              </span><span class="user-status">
                <?php
                if ($perm == '1') {
                  echo $fullname = "Admin";
                } else {
                  $getfullname = $mysqli->query("select * from staff where username = '$username'");
                  $resfullname = $getfullname->fetch_assoc();
                  $fullname = $resfullname['fullname'];
                  echo "Staff";
                }

                ?>
              </span></div><span class="avatar"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <a class="dropdown-item" href="profile"><i class="me-50" data-feather="user"></i> Profile</a>
            <a class="dropdown-item" href="changepassword"><i class="me-50" data-feather="key"></i> Change <br />Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="login"><i class="me-50" data-feather="power"></i> Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <!-- END: Header-->


  <!-- BEGIN: Main Menu-->
  <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item me-auto"><a class="navbar-brand" href="/">
            <span class="brand-logo">
              <img src="<?php echo getLogo(); ?>" />
            </span>
            <h2 class="brand-text" style="font-size:14px"><?php echo getCompNameHeader(getChurchName()); ?></h2>
          </a></li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content mt-1">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/index.php" ? "active" : ""); ?> nav-item">
          <a class="d-flex align-items-center" href="/">
            <i data-feather="airplay"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
          </a>
        </li>

        <?php
        // Get Permissions

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and (permission = 'Add, View and Search Products'
            OR permission = 'New Arrivals'
            OR permission = 'Categories, Subcategories and Variations'
            )");
        if (mysqli_num_rows($getpermission) > 0 || $perm == '1') { ?>


          <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i>
              <span class="menu-title text-truncate">Products</span></a>
            <ul class="menu-content">
              <?php
              // Get Permissions

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
          and permission = 'Add, View and Search Products'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/addproduct.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="addproduct"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Add Product</span></a>
                </li>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/viewproducts.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="viewproducts"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate">View Products</span></a>
                </li>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/searchproducts.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="searchproducts"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Search Products</span></a>
                </li>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/pricelists.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="pricelists"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate">Price Lists</span></a>
                </li>
              <?php }

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
          and permission = 'New Arrivals'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/newarrivals.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="newarrivals"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate">New Arrivals</span></a>
                </li>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/viewnewarrivals.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="viewnewarrivals"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate">View New Arrivals</span></a>
                </li>

              <?php } ?>

            </ul>
          </li>

        <?php } ?>





        <?php
        // Get Permissions

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and (permission = 'Add and View Sales'
            OR permission = 'Sales Statistics'
            )");
        if (mysqli_num_rows($getpermission) > 0 || $perm == '1') { ?>

          <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="dollar-sign"></i>
              <span class="menu-title text-truncate" data-i18n="Sales">Sales</span></a>
            <ul class="menu-content">

              <?php
              // Get Permissions

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'Add and View Sales'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/addsale.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="addsale"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="AddS">Add Sale</span></a>
                </li>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/viewsales.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="viewsales"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">View Sales</span></a>
                </li>

              <?php }

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
              and permission = 'Sales Statistics'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/salesstatistics.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="salesstatistics"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Statistics">Statistics</span></a>
                </li>

              <?php } ?>

            </ul>
          </li>
        <?php } ?>




        <?php
        // Get Permissions

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and (permission = 'Add and View Customers'
            OR permission = 'Customers Statistics'
            )");
        if (mysqli_num_rows($getpermission) > 0 || $perm == '1') { ?>

          <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user-check"></i>
              <span class="menu-title text-truncate" data-i18n="Customers">Customers</span></a>
            <ul class="menu-content">

              <?php
              // Get Permissions

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'Add and View Customers'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/addcustomer.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="addcustomer"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="AddC">Add Customer</span></a>
                </li>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/viewcustomers.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="viewcustomers"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="ViewP">View Customers</span></a>
                </li>

              <?php }

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'Customer Statistics'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/customerstatistics.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="customerstatistics"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Statistics">Statistics</span></a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>





        <?php
        // Get Permissions

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and (permission = 'Add and View Suppliers'
            OR permission = 'Suppliers Statistics'
            )");
        if (mysqli_num_rows($getpermission) > 0 || $perm == '1') { ?>
          <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user-plus"></i>
              <span class="menu-title text-truncate" data-i18n="Suppliers">Suppliers</span></a>
            <ul class="menu-content">

              <?php
              // Get Permissions

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'Add and View Suppliers'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/addsupplier.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="addsupplier"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="AddS">Add Supplier</span></a>
                </li>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/viewsuppliers.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="viewsuppliers"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="ViewS">View Suppliers</span></a>
                </li>

              <?php }

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'Suppliers Statistics'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/supplierstatistics.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="supplierstatistics"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Statistics">Statistics</span></a>
                </li>

              <?php } ?>

            </ul>
          </li>
        <?php } ?>





        <?php
        // Get Permissions

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and (permission = 'Add and View Expenses'
            OR permission = 'Expenses Statistics'
            )");
        if (mysqli_num_rows($getpermission) > 0 || $perm == '1') { ?>
          <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="pie-chart"></i>
              <span class="menu-title text-truncate" data-i18n="Customers">Expenses</span></a>
            <ul class="menu-content">

              <?php
              // Get Permissions

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'Add and View Expenses'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/addexpense.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="addexpense"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="AddE">Add Expense</span></a>
                </li>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/viewexpenses.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="viewexpenses"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="ViewE">View Expenses</span></a>
                </li>

              <?php }

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'Expenses Statistics'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/expensestatistics.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="expensestatistics"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Statistics">Statistics</span></a>
                </li>

              <?php } ?>

            </ul>
          </li>
        <?php } ?>





        <?php
        // Get Permissions

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and (permission = 'Add and View Users'
            OR permission = 'User Permissions'
            )");
        if (mysqli_num_rows($getpermission) > 0 || $perm == '1') { ?>
          <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="users"></i>
              <span class="menu-title text-truncate" data-i18n="Users">Users</span></a>
            <ul class="menu-content">

              <?php
              // Get Permissions

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'Add and View Users'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/adduser.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="adduser"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="AddU">Add User</span></a>
                </li>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/viewusers.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="viewusers"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="ViewU">View Users</span></a>
                </li>

              <?php }

              $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
            and permission = 'User Permissions'");
              if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/userpermissions.php" ? "active" : ""); ?>">
                  <a class="d-flex align-items-center" href="userpermissions"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Permissions">Permissions</span></a>
                </li>

              <?php } ?>

            </ul>
          </li>
        <?php } ?>




        <li class=" navigation-header"><span data-i18n="Extras">Extras</span><i data-feather="more-horizontal"></i>
        </li>

        <?php

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
          and permission = 'Inventory'");
        if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

          <li class="<?php echo ($_SERVER['PHP_SELF'] == "/inventory.php" ? "active" : ""); ?>">
            <a class="d-flex align-items-center" href="inventory"><i data-feather="layers"></i>
              <span class="menu-item text-truncate" data-i18n="Inventory">Inventory</span></a>
          </li>

        <?php } ?>

        <!--  <li class=" nav-item"><a class="d-flex align-items-center" href="#">
              <i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Price Rules">Price Rules</span></a>
          </li>
          <li class=" nav-item"><a class="d-flex align-items-center" href="#">
              <i data-feather="truck"></i><span class="menu-title text-truncate" data-i18n="Deliveries">Deliveries</span></a>
          </li>
          <li class=" nav-item"><a class="d-flex align-items-center" href="#">
              <i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="Returned">Returned Items</span></a>
          </li>
          -->

        <li class="<?php echo ($_SERVER['PHP_SELF'] == "/client_messages.php" ? "active" : ""); ?> nav-item"><a class="d-flex align-items-center" href="client_messages">
            <i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Price Rules">Client Messages</span></a>
        </li>

        <?php
        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
          and permission = 'Gift Cards'");
        if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>


          <li class="<?php echo ($_SERVER['PHP_SELF'] == "/giftcard.php" ? "active" : ""); ?> nav-item">
            <a class="d-flex align-items-center" href="giftcard">
              <i data-feather="award"></i><span class="menu-title text-truncate" data-i18n="Gift Cards">Gift Cards</span></a>
          </li>

        <?php }

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
          and permission = 'Messages'");
        if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>


          <li class="<?php echo ($_SERVER['PHP_SELF'] == "/messages.php" ? "active" : ""); ?> nav-item">
            <a class="d-flex align-items-center" href="messages">
              <i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Messages">Messages</span></a>
          </li>

        <?php }

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
          and permission = 'Logs'");
        if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>


          <li class="<?php echo ($_SERVER['PHP_SELF'] == "/logs.php" ? "active" : ""); ?> nav-item">
            <a class="d-flex align-items-center" href="logs">
              <i data-feather="database"></i><span class="menu-title text-truncate" data-i18n="Logs">Logs</span></a>
          </li>

        <?php }

        $getpermission = $mysqli->query("select * from userpermission where userid = '$user_id' 
          and permission = 'Store Configuration'");
        if (mysqli_num_rows($getpermission) == '1' || $perm == '1') { ?>

          <li class="<?php echo ($_SERVER['PHP_SELF'] == "/storeconfig.php" ? "active" : ""); ?> nav-item">
            <a class="d-flex align-items-center" href="storeconfig">
              <i data-feather="clipboard"></i><span class="menu-title text-truncate" data-i18n="Store Config">Store Config</span></a>
          </li>

        <?php } ?>

        <li class=" nav-item"><a class="d-flex align-items-center" href="closing">
            <i data-feather="log-out"></i><span class="menu-title text-truncate" data-i18n="Log Out">Closing Accounts</span></a>
        </li>

        <li class=" nav-item"><a class="d-flex align-items-center" href="login">
            <i data-feather="save"></i><span class="menu-title text-truncate" data-i18n="Log Out">Log out</span></a>
        </li>

      </ul>
    </div>
  </div>
  <!-- END: Main Menu-->