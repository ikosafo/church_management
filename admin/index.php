<?php
include('includes/header.php');
include('../functions.php');
?>


<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">

                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="fw-bolder mb-0">
                                        <?php
                                        $getbranch = $mysqli->query("select * from `branch`");
                                        echo mysqli_num_rows($getbranch);
                                        ?>

                                    </h2>
                                    <p class="card-text">Branches</p>
                                </div>
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="home" style="width: 22px;height:22px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="fw-bolder mb-0">
                                        <?php
                                        $getusers = $mysqli->query("select * from `users_admin`");
                                        echo mysqli_num_rows($getusers);
                                        ?>
                                    </h2>
                                    <p class="card-text">Branch Admin</p>
                                </div>
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="user-plus" style="width: 22px;height:22px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="fw-bolder mb-0"> <?php
                                                                $getmem = $mysqli->query("select * from `members`");
                                                                echo mysqli_num_rows($getmem);
                                                                ?>
                                    </h2>
                                    <p class="card-text">Members</p>
                                </div>
                                <div class="avatar bg-light-success p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="users" style="width: 22px;height:22px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="fw-bolder mb-0">
                                        <?php
                                        $getcon = $mysqli->query("select * from `convert`");
                                        echo mysqli_num_rows($getcon);
                                        ?></h2>
                                    <p class="card-text">New Converts</p>
                                </div>
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="user" style="width: 22px;height:22px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="fw-bolder mb-0">
                                        <?php
                                        $getcon = $mysqli->query("select * from `visitor`");
                                        echo mysqli_num_rows($getcon);
                                        ?></h2>
                                    <p class="card-text">Visitors</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="fw-bolder mb-0">
                                        <?php
                                        $getmale = $mysqli->query("select * from `members` where gender = 'Male'");
                                        echo mysqli_num_rows($getmale);
                                        ?>

                                    </h2>
                                    <p class="card-text">Males</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="fw-bolder mb-0">
                                        <?php
                                        $getfemale = $mysqli->query("select * from `members` where gender = 'Female'");
                                        echo mysqli_num_rows($getfemale);
                                        ?>
                                    </h2>
                                    <p class="card-text">Females</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="fw-bolder mb-0"> <?php
                                                                $getmem = $mysqli->query("select * from `members` where communicant = 'Yes'");
                                                                echo mysqli_num_rows($getmem);
                                                                ?>
                                    </h2>
                                    <p class="card-text">Communicants</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>



            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>
<!-- END: Content-->


<?php include('includes/footer.php') ?>

<script>
    $("#viewlogs").click(function() {
        window.location.href = "/userlogs";
    });

    $(document).ready(function() {
        setInterval(runningTime, 1000);
    });

    function runningTime() {
        $.ajax({
            url: '../indextimeScript.php',
            success: function(data) {
                $('#runningTime').html(data);
            },
        });
    }
</script>