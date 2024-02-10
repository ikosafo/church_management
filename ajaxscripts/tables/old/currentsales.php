<?php
include('../../config.php');
include('../../functions.php');

$getdate = $mysqli->query("SELECT DISTINCT(SUBSTR(`datetime`,1,10)) as date FROM `sales` ORDER BY `datetime` DESC");

?>


<section id="accordion-with-margin">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">

        <div class="card-body">
          <p class="card-text">
            Click date to view details of sales
          </p>
          <div class="accordion accordion-margin" id="accordionMargin" data-toggle-hover="true">

            <?php
            $getsaledetails = $mysqli->query("SELECT DISTINCT(SUBSTR(`datetime`,1,10)) as date FROM `sales` 
                                    ORDER BY `datetime` DESC");
            while ($ressalesdetails = $getsaledetails->fetch_assoc()) { ?>


              <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?php echo $ressalesdetails['date']; ?>">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion<?php echo $ressalesdetails['date']; ?>" aria-expanded="false" aria-controls="accordion<?php echo $ressalesdetails['date']; ?>">
                    <?php echo $date = $ressalesdetails['date']; ?>
                  </button>
                </h2>
                <div id="accordion<?php echo $ressalesdetails['date']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $ressalesdetails['date']; ?>" data-bs-parent="#accordionMargin">
                  <div class="accordion-body">
                    <?php $getsales = $mysqli->query("select * from `sales` where SUBSTR(`datetime`,1,10) = '$date' ORDER BY `salesid` DESC"); ?>
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th width="5%">No.</th>
                          <th width="30%">Details</th>
                          <th width="10%">Total<br /> Price</th>
                          <th width="10%">Amount<br /> Paid</th>
                          <th width="10%">Change<br /> Given</th>
                          <th width="10%">Payment<br /> Method</th>
                          <th width="10%">Transaction <br /> Period</th>
                          <th width="10%">Transaction <br /> User</th>
                          <th width="5%">Print Receipt</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $count = 1;
                        while ($ressales = $getsales->fetch_assoc()) {

                        ?>
                          <tr>
                            <td>
                              <?php echo $count; ?>
                            </td>
                            <td>
                              <?php
                              $newsaleid = $ressales['newsaleid'];
                              $gettemp = $mysqli->query("select * from `tempsales` where `genid` = '$newsaleid'");
                              ?>

                              <table class="table table-borderless">
                                <?php while ($restemp = $gettemp->fetch_assoc()) { ?>
                                  <tr>
                                    <td width="40%">
                                      <?php
                                      $prodid = $restemp['prodid'];
                                      echo getProductName($prodid); ?>
                                    </td>
                                    <td width="20%">
                                      <?php echo $quantity =  $restemp['quantity']; ?>
                                    </td>
                                    <td width="40%">
                                      <?php echo "GHS " . $restemp['price'] ?>
                                    </td>

                                  </tr>
                                <?php }
                                ?>
                              </table>

                            </td>
                            <td><?php echo $ressales['totalprice']; ?></td>
                            <td><?php echo $ressales['amountpaid']; ?></td>
                            <td><?php echo $ressales['change']; ?></td>
                            <td><?php echo $ressales['paymentmethod']; ?></td>
                            <td><?php echo $ressales['datetime']; ?></td>
                            <td><?php echo getLogname($ressales['username']); ?></td>
                            <td><a href="#" class="printreceipt" i_index=<?php echo $ressales['newsaleid'] ?>>Print</td>

                          </tr>
                        <?php
                          $count++;
                        }
                        ?>
                        <tr>
                          <td colspan="2"></td>
                          <td><b>
                              <?php
                              //get the total
                              $getsum = $mysqli->query("select sum(`totalprice`) as totprice from `sales` 
                                                where SUBSTR(`datetime`,1,10) = '$date'");
                              $ressum = $getsum->fetch_assoc();
                              $totalprice = $ressum['totprice'];
                              $format = number_format($totalprice, 2);
                              echo "<b>GHS " . $format . '</b>';
                              ?></b></td>
                          <td>
                            <?php
                            //get the total
                            $getsum = $mysqli->query("select sum(`amountpaid`) as totprice from `sales` 
                                                        where SUBSTR(`datetime`,1,10) = '$date'");
                            $ressum = $getsum->fetch_assoc();
                            $totalprice = $ressum['totprice'];
                            $format = number_format($totalprice, 2);
                            echo "<b>GHS " . $format . '</b>';
                            ?>
                          </td>
                          <td>
                            <?php
                            //get the total
                            $getsum = $mysqli->query("select sum(`change`) as totprice from `sales` 
                                                        where SUBSTR(`datetime`,1,10) = '$date'");
                            $ressum = $getsum->fetch_assoc();
                            $totalprice = $ressum['totprice'];
                            $format = number_format($totalprice, 2);
                            echo "<b>GHS " . $format . '</b>';
                            ?>
                          </td>
                          <td colspan="3"></td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            <?php } ?>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>