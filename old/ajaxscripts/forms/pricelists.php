<?php

include('../../config.php');
include("../../functions.php");

//$newsaleid = $_POST['newsaleid'];

$getproduct = $mysqli->query("SELECT * FROM products");

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
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.html">
    <link rel="shortcut icon" type="image/x-icon" href="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-wizard.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-ecommerce.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/charts/chart-apex.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/uploadifive/uploadifive.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/jquery-confirm.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

    <style>
        .header {
            text-align: center;
            border-bottom: 1px solid #000;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        h2 {
            font-size: 18px !important;
        }

        .content-body .py-1 {
            padding-top: 0.3rem !important;
            padding-bottom: 0.3rem !important;
        }

        .content-body * {
            font-size: 10px;
        }

        .content-body table {
            padding: 8px;
        }

        .content-body table td,
        .content-body table th {
            padding: 8px;
        }
    </style>


</head>

<body>

    <!-- BEGIN: Content-->
    <div class="app-content content" style="margin-left:0;padding:0">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">
                <div class="invoice-print p-3" id="print_this">

                    <div class="header mb-3">
                        <h2>Price List</h2>
                    </div>
                    <div class="invoice-header d-flex justify-content-between flex-md-row flex-column pb-2" style="margin-top: -33px;">
                        <div>
                            <div class="d-flex align-items-center" style="display: flex; gap: 10px">
                                <div>
                                    <img src="../../../<?php echo getLogo(); ?>" style="width: 30px; height: 30px">
                                </div>

                                <div class="mt-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="text-primary fw-bold" style="font-size: 13px;"><?php echo getCompanyName(); ?></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="mb-25" style="margin-top: -9px;text-transform:capitalize"><?php echo getCompanyTagline(); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-1">
                                <p class="mb-0">Address: <?php echo getCompanyAddress(); ?></p>
                                <p class="mb-0">Tel: <?php echo getCompanyTelephone(); ?></p>
                                <p class="mb-0">Email: <?php echo getCompanyEmail(); ?></p>
                                <p class="mb-0">Whatsapp: <?php echo getCompanyWhatsapp(); ?></p>
                            </div>

                        </div>

                        <div class="mt-md-0 mt-1">

                            <div class="invoice-date-wrapper mb-25">
                                <span class="invoice-date-title">Date:</span>
                                <span class="fw-bold">
                                    <?php echo $convertedDate = date("d-M-Y"); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2">

                    <div class="table-responsive mt-2">
                        <table class="table m-0 table-sm">
                            <thead>
                                <tr>
                                    <th class="py-1" width="5%">No.</th>
                                    <th class="py-1">Product</th>
                                    <th class="py-1">Quantity</th>
                                    <th class="py-1">Unit Price (GHC)</th>
                                    <th class="py-1">Expiry Date</th>
                                    <th class="py-1">Discount</th>
                                    <th class="py-1">Amount</th>
                                </tr>
                            </thead>
                            <tbody>



                                <?php
                                $count = 1;
                                while ($resproduct = $getproduct->fetch_assoc()) { ?>

                                    <tr>
                                        <td style="text-align: center;">
                                            <?php echo $count; ?>
                                        </td>
                                        <td class="py-1 ps-4">
                                            <div>
                                                <div class="fw-bolder">
                                                    <?php
                                                    $charactersToRemove = ['"', "'", ','];
                                                    echo $productname = getProductName($resproduct['prodid']);
                                                    $modifiedString = str_replace($charactersToRemove, '', $productname);

                                                    // Output the modified string
                                                    //echo $modifiedString;
                                                    ?>

                                                </div>
                                                <div class="font-small-2 text-muted" style="font-size: 9px !important;">
                                                    <?php

                                                    // Create a prepared statement
                                                    $stmt = $mysqli->prepare("SELECT * FROM products WHERE productname = ?");

                                                    // Bind the parameter to the prepared statement
                                                    $stmt->bind_param("s", $productname);

                                                    // Execute the query
                                                    $stmt->execute();

                                                    // Get the result
                                                    $result = $stmt->get_result();

                                                    // Fetch the row
                                                    $resvariation = $result->fetch_assoc();

                                                    // Output the variations
                                                    if ($resvariation) {
                                                        echo $resvariation['variations'];
                                                    } else {
                                                        echo "";
                                                    }

                                                    // Close the statement
                                                    $stmt->close();


                                                    /* $getvariation = $mysqli->query("SELECT * FROM products WHERE productname = '$productname'");
                                                    $resvariation = $getvariation->fetch_assoc();

                                                    if ($resvariation) {
                                                        $variation = $resvariation['variations'];
                                                        echo str_replace($charactersToRemove, '', $variation);
                                                    } else {
                                                        // Handle the case where no variation is found
                                                        echo '';
                                                    } */
                                                    ?>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <?php echo $resproduct['quantity']; ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo number_format($resproduct['sellingprice'] + (0.1 * $resproduct['sellingprice']), 2); ?>
                                        </td>
                                        <td class="py-1">
                                            <?php
                                            $expiryDate = $resproduct['expirydate'];

                                            // Check if $expiryDate is a valid date
                                            if (strtotime($expiryDate) !== false) {
                                                // Convert and echo the formatted date
                                                echo date('d-M-y', strtotime($expiryDate));
                                            } else {
                                                // $expiryDate is not a valid date, echo an empty string
                                                echo "";
                                            }
                                            ?>

                                        </td>

                                        <td class="py-1">
                                            <?php echo number_format(0.1 * $resproduct['sellingprice'], 2); ?>
                                        </td>
                                        <td class="py-1">
                                            <?php echo $resproduct['sellingprice']; ?>
                                        </td>
                                    </tr>

                                <?php $count++;
                                }

                                ?>
                                <!--  <tr>
                                    <td colspan="5"></td>
                                    <td class="py-1">
                                        <strong><?php echo $totalprice; ?></strong>
                                    </td>
                                </tr> -->

                            </tbody>
                        </table>
                    </div>



                    <hr class="my-2">

                    <div class="row">
                        <div class="col-12">
                            <p class="mt-2">We appreciate your patronage at <?php echo getCompanyName(); ?>.
                                Your support means a lot to us. Thank you for choosing our products.</p>
                        </div>
                    </div>

                    <a href="#" id="printbutton" class="btn btn-primary me-1 waves-effect waves-float waves-light">Print Price Lists</a>
                </div>

            </div>
        </div>
    </div>

</body>

<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="../../../app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="../../../app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="../../../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
<script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="../../../app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
<script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="../../../app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="../../../app-assets/js/core/app-menu.min.js"></script>
<script src="../../../app-assets/js/core/app.min.js"></script>
<script src="../../../app-assets/js/scripts/customizer.min.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="../../../app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>
<!-- END: Page JS-->
<script src="../../../app-assets/uploadifive/jquery.uploadifive.js"></script>
<script src="../../../app-assets/js/scripts/components/notify.js"></script>
<script src="../../../app-assets/js/scripts/components/jquery.blockUI.js"></script>

<script src="../../../app-assets/js/scripts/tables/table-datatables-basic.min.js"></script>
<script src="../../../app-assets/js/scripts/components/components-tooltips.min.js"></script>
<script src="../../../app-assets/js/scripts/jquery-confirm.min.js"></script>
<script src="../../../app-assets/js/scripts/forms/form-number-input.min.js"></script>

<!-- <script src="../../../app-assets/js/scripts/forms/form-wizard.min.js"></script> -->
<script src="../../../app-assets/js/scripts/print.js"></script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })

    function print() {
        printJS({
            printable: 'print_this',
            type: 'html',
            targetStyles: ['*']
        })
    }

    document.getElementById('printbutton').addEventListener("click", print)
</script>
</body>
<!-- END: Body-->

</html>