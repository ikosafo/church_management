<?php require('includes/header.php');
$branch = $_SESSION['branch'];
?>
    <!-- begin:: Subheader -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader"></div>
    <!-- end:: Subheader -->
                    <!-- begin:: Content -->
                    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                        <!--Begin::Dashboard 3-->

                        <div class="row">
                            <div class="col-xl-12">
                                <!--begin:: Widgets/Applications/User/Profile3-->
                                <div class="kt-portlet kt-portlet--height-fluid">
                                    <div class="kt-portlet__body">
                                        <div class="kt-widget kt-widget--user-profile-3">
                                            <div class="kt-widget__top">

                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__head">
                                                        <a href="#" class="kt-widget__username">
                                                            <?php echo $_SESSION['fullname']; ?>
                                                            <i class="flaticon2-user"></i>
                                                        </a>
                                                    </div>

                                                    <div class="kt-widget__subhead">
                                                        <a href="#"><i class="flaticon2-user-1"></i><?php echo $_SESSION['username']; ?></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="kt-widget__bottom">

                                                <div class="kt-widget__item">
                                                    <div class="kt-widget__details">
                                                        <span class="kt-widget__title">Total Members</span>
                                                        <span class="kt-widget__value"><span><i class="flaticon-users-1"></i> </span>
                                                            <?php
                                                            $getperm = $mysqli->query("select * from `member` where
                                                             branch = '$branch'");
                                                            echo mysqli_num_rows($getperm);
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="kt-widget__item">
                                                    <div class="kt-widget__details">
                                                        <span class="kt-widget__title">Males</span>
                                                        <span class="kt-widget__value"><span><i class="flaticon2-user"></i> </span>
                                                        <?php
                                                        $getperm = $mysqli->query("select * from `member` where
                                                             gender = 'Male' and branch = '$branch'");
                                                        echo mysqli_num_rows($getperm);
                                                        ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="kt-widget__item">
                                                    <div class="kt-widget__details">
                                                        <span class="kt-widget__title">Females</span>
                                                        <span class="kt-widget__value"><span><i class="flaticon2-user-1"></i> </span>
                                                        <?php
                                                        $getperm = $mysqli->query("select * from `member` where
                                                              gender = 'Female' and branch = '$branch'");
                                                        echo mysqli_num_rows($getperm);
                                                        ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="kt-widget__item">
                                                    <div class="kt-widget__details">
                                                        <span class="kt-widget__title">Church Workers</span>
                                                        <span class="kt-widget__value"><span><i class="flaticon-users"></i> </span>
                                                        <?php
                                                        $getperm = $mysqli->query("select * from `branchworker`
                                                                 where branch = '$branch'");
                                                        echo mysqli_num_rows($getperm);
                                                        ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="kt-widget__item">
                                                    <div class="kt-widget__details">
                                                        <span class="kt-widget__title">Departments</span>
                                                        <span class="kt-widget__value"><span><i class="flaticon-folder-1"></i> </span>
                                                        <?php
                                                        $getperm = $mysqli->query("select * from `department` where branch = '$branch'");
                                                        echo mysqli_num_rows($getperm);
                                                        ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="kt-widget__item">
                                                    <div class="kt-widget__details">
                                                        <span class="kt-widget__title">Cells</span>
                                                        <span class="kt-widget__value"><span><i class="flaticon-folder-1"></i> </span>
                                                            <?php
                                                            $getperm = $mysqli->query("select * from `cell` where branch = '$branch'");
                                                            echo mysqli_num_rows($getperm);
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="kt-widget__item">
                                                    <div class="kt-widget__details">
                                                        <span class="kt-widget__title">Ministries</span>
                                                        <span class="kt-widget__value"><span><i class="flaticon-folder-1"></i> </span>
                                                            <?php
                                                            $getperm = $mysqli->query("select * from `ministry` where branch = '$branch'");
                                                            echo mysqli_num_rows($getperm);
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end:: Widgets/Applications/User/Profile3-->
                            </div>
                        </div>

                       	</div>
                    <!-- end:: Content -->

<?php require('includes/footer.php') ?>

<script>
    //alert("SITE WILL SHUTDOWN ON WEDNESDAY DUE TO NON-PAYMENT OF FEES");
    "use strict";
    var KTDatatableHtmlTableDemo = {
        init: function () {
            var t;
            t = $(".kt-datatable").KTDatatable({
                data: {saveState: {cookie: !1}},
                search: {input: $("#generalSearch")},
                columns: [
                    {field: "DepositPaid", type: "number"}, {
                    field: "OrderDate", type: "date", format: "YYYY-MM-DD"},
                    {
                    field: "Status", title: "Status", autoHide: !1, template: function (t) {
                        var e = {
                            1: {title: "Pending", class: "kt-badge--brand"},
                            2: {title: "Approved", class: " kt-badge--success"},
                            3: {title: "Rejected", class: " kt-badge--danger"},
                            4: {title: "Success", class: " kt-badge--success"},
                            5: {title: "Info", class: " kt-badge--info"},
                            6: {title: "Danger", class: " kt-badge--danger"},
                            7: {title: "Warning", class: " kt-badge--warning"}
                        };
                        return '<span class="kt-badge ' + e[t.Status].class + ' kt-badge--inline kt-badge--pill">' + e[t.Status].title + "</span>"
                    }
                },
                    {
                    field: "Type", title: "Type", autoHide: !1, template: function (t) {
                        var e = {
                            1: {title: "Permanent", state: "danger"},
                            2: {title: "Provisional", state: "primary"},
                            3: {title: "Temporal", state: "success"},
                            4: {title: "Examination", state: "info"},
                            5: {title: "Renewal", state: "warning"},
                            6: {title: "Indexing", state: "success"},
                            7: {title: "None", state: "warning"},
                        };
                        return '<span class="kt-badge kt-badge--' + e[t.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + e[t.Type].state + '">' + e[t.Type].title + "</span>"
                    }
                }]
            }), $("#kt_form_status").on("change", function () {
                t.search($(this).val().toLowerCase(), "Status")
            }), $("#kt_form_type").on("change", function () {
                t.search($(this).val().toLowerCase(), "Type")
            }), $("#kt_form_status,#kt_form_type").selectpicker()
        }
    };
    jQuery(document).ready(function () {
        KTDatatableHtmlTableDemo.init()
    });
</script>

