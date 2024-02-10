<?php
/* db connection */
include('config.php');
include('functions.php');

/* Check whether system configuration has been filled  */
$getsystemconfig = $mysqli->query("select * from system_config");
$getcount = mysqli_num_rows($getsystemconfig);
//redirect if it is not
if ($getcount == "0") {
  if ($_SERVER['REQUEST_URI'] == "/systemconfig") {
    echo "";
  } else {
    header("location:systemconfig");
  }
} else {
  if ($_SERVER['REQUEST_URI'] == "/login" || $_SERVER['REQUEST_URI'] == "/forgotpassword" || $_SERVER['REQUEST_URI'] == "/resetpassword") {
    echo "";
  } else {
    header("location:login");
  }
}

?>

<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="description" content="Login - Church Management System">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <title>Login - Church Management System</title>
  <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.html">
  <!-- <link rel="shortcut icon" type="image/x-icon" href="<?php echo getLogo(); ?>"> -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

  <!-- BEGIN: Vendor CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/select/select2.min.css">
  <!-- END: Vendor CSS-->

  <!-- BEGIN: Theme CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/colors.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/components.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/themes/bordered-layout.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.min.css">

  <!-- BEGIN: Page CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-validation.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/pages/authentication.css">
  <link rel="stylesheet" type="text/css" href="app-assets/uploadifive/uploadifive.css">
  <!-- END: Page CSS-->

  <!-- BEGIN: Custom CSS-->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <!-- END: Custom CSS-->

  <style>
    body {
      background-image: url('../app-assets/images/bgimg2.jpg');
      background-size: cover;
    }
  </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
  <!-- BEGIN: Content-->
  <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <div class="auth-wrapper auth-basic px-2">