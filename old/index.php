<?php include('includes/header.php');
include('functions.php');
?>


<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
    </div>
    <div class="content-body"><!-- Dashboard Ecommerce Starts -->
      <section id="dashboard-ecommerce">

        <div class="row">
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                <div>
                  <h2 class="fw-bolder mb-0">
                    <?php
                    // Get total sales in a day
                    $gettodaysale = $mysqli->query("SELECT SUM(totalprice) AS tot FROM sales WHERE SUBSTRING(datetime, 1, 10) = CURDATE()");
                    $ressale = $gettodaysale->fetch_assoc();

                    // Check if $ressale['tot'] is not null before using number_format
                    $totalSales = isset($ressale['tot']) ? number_format($ressale['tot'], 2) : '0.00';

                    echo $totalSales;
                    ?>

                  </h2>
                  <p class="card-text">Sales for Today</p>
                </div>
                <div class="avatar bg-light-primary p-50 m-0">
                  <div class="avatar-content">
                    <i data-feather="shopping-cart" style="width: 22px;height:22px"></i>
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
                    // Get total sales in a day
                    $getthreshold = $mysqli->query("select * from products where  stockthreshold > quantity");
                    echo mysqli_num_rows($getthreshold);
                    ?>
                  </h2>
                  <p class="card-text">Below Threshold</p>
                </div>
                <div class="avatar bg-light-warning p-50 m-0">
                  <div class="avatar-content">
                    <i data-feather="alert-triangle" style="width: 22px;height:22px"></i>
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
                                              // Get total sales in a day
                                              $getcount = $mysqli->query("select * from staff where status IS NULL");
                                              echo mysqli_num_rows($getcount);
                                              ?>
                  </h2>
                  <p class="card-text">Account Holders</p>
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
                  <h2 class="fw-bolder mb-0"><?php
                                              // Get total sales in a day
                                              $getcount = $mysqli->query("select * from products where status IS NULL");
                                              echo mysqli_num_rows($getcount);
                                              ?></h2>
                  <p class="card-text">Total Products</p>
                </div>
                <div class="avatar bg-light-warning p-50 m-0">
                  <div class="avatar-content">
                    <i data-feather="shopping-bag" style="width: 22px;height:22px"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row match-height">

          <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-apply-job">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <div class="d-flex flex-row">
                    <div class="user-info">
                      <h5 class="mb-0">
                        <?php

                        if ($perm == '1') {
                          echo $username;
                        } else {
                          //get full name
                          $getfullname = $mysqli->query("select * from staff where username = '$username'");
                          $resfullname = $getfullname->fetch_assoc();
                          echo $fullname = $resfullname['fullname'];
                        }

                        ?>
                      </h5>
                      <small class="text-muted"><?php
                                                //Get last updated time
                                                $gettime = $mysqli->query("select * from logs where section = 'Login'ORDER BY logid DESC LIMIT 1");
                                                $restime = $gettime->fetch_assoc();
                                                echo "Logged in " . time_elapsed_string($restime['logdate']);
                                                ?>
                      </small>
                    </div>
                  </div>
                  <span class="badge rounded-pill badge-light-primary"><?php if ($fullname == "Admin") {
                                                                          echo "Admin";
                                                                        } else {
                                                                          echo "Staff";
                                                                        } ?></span>
                </div>

                <div class="apply-job-package bg-light-primary rounded">
                  <i data-feather="calendar" style="width: 22px;height:22px"></i>
                  <div id="runningTime" style="margin:0 auto"></div>
                </div>
                <div class="d-grid">
                  <a href="todaysales" class="btn btn-success mb-1 waves-effect waves-float waves-light">
                    View today's sales
                  </a>
                  <a href="todaysexpenses" class="btn btn-danger mb-1 waves-effect waves-float waves-light">
                    View today's expenses
                  </a>
                  <a href="userlogs" class="btn btn-primary waves-effect waves-float waves-light">
                    View logs
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-8 col-12">
            <div class="row match-height">

              <!-- Transaction Card -->
              <div class="col-lg-12 col-md-6 col-12">
                <div class="card card-transaction">
                  <div class="card-header">
                    <h4 class="card-title">Highest Transactions for Today</h4>
                  </div>
                  <div class="card-body">

                    <?php
                    //Get highest transactions
                    $gettransactions = $mysqli->query("SELECT * FROM sales s JOIN tempsales t ON s.`newsaleid` = t.`genid` WHERE 
                      SUBSTRING(s.`datetime`,1,10) = curdate() ORDER BY t.`price` DESC, s.`totalprice` DESC LIMIT 4");
                    while ($restransactions = $gettransactions->fetch_assoc()) { ?>

                      <div class="transaction-item">
                        <div class="d-flex">
                          <div class="transaction-percentage">
                            <h6 class="transaction-title"><?php echo getProductName($restransactions['prodid']); ?></h6>
                            <small>Quantity: <?php echo $restransactions['quantity']; ?></small>
                          </div>
                        </div>
                        <div class="fw-bolder text-success"><?php echo $restransactions['price']; ?></div>
                      </div>

                    <?php }
                    ?>


                  </div>
                </div>
              </div>
              <!--/ Transaction Card -->

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
</script>

<script type="text/javascript">
  $(document).ready(function() {
    setInterval(runningTime, 1000);
  });

  function runningTime() {
    $.ajax({
      url: 'indextimeScript.php',
      success: function(data) {
        $('#runningTime').html(data);
      },
    });
  }
</script>