     <?php

      include('../../../config.php');
      include("../../../functions.php");

      $newsaleid = $_POST['newsaleid'];

      //Get invoice ID
      $getsale = $mysqli->query("select * from sales where newsaleid = '$newsaleid'");
      $ressale = $getsale->fetch_assoc();
      $salesid = $ressale['salesid'];
      $customer = $ressale['customer'];
      $date = substr($ressale['datetime'], 0, 10);
      $length = 5;
      $string = substr(str_repeat(0, $length) . $salesid, -$length);
      $invoiceid = $string . '' . date('y');

      ?>


     <!-- <style>
    .printdetails {
         display: none;
        }

    @media print {
        .printdetails {
            display: block;
        }
    }
</style>
 -->
     <script>
       function printContent(el) {
         var restorepage = document.body.innerHTML;
         var printcontent = document.getElementById(el).innerHTML;
         document.body.innerHTML = printcontent;
         window.print();
         document.body.innerHTML = restorepage;
         window.location.href = "/addsale"
       }
     </script>


     <div class="printdetails invoice-print p-3" id="printthis">
       <div class="invoice-header d-flex justify-content-between flex-md-row flex-column pb-2">
         <div>
           <div class="d-flex mb-1">
             <img src="<?php echo getLogo(); ?>" style="width:5%" />
           </div>
           <p class="mb-25"><?php echo getCompanyName(); ?></p>
           <p class="mb-25"><?php echo getCompanyTagline(); ?></p>
           <p class="mb-25"><?php echo getCompanyAddress(); ?></p>
           <p class="mb-0">Tel: <?php echo getCompanyTelephone(); ?></p>
         </div>
         <div class="mt-md-0 mt-2">
           <h6 class="fw-bold text-end mb-1">INVOICE #: <?php echo $invoiceid; ?></h6>
           <div class="invoice-date-wrapper mb-50">
             <span class="invoice-date-title">Date Issued:</span>
             <span class="fw-bold"> <?php echo $date; ?></span>
           </div>
           <h6 class="mb-1">Invoice To:</h6>
           <p class="mb-25"><?php echo $customer; ?></p>
         </div>
       </div>
       <?php
        //Get items sold
        $getitems = $mysqli->query("select * from tempsales where genid = '$newsaleid'");
        ?>

       <div class="table-responsive mt-2" style="overflow-x:hidden !important">
         <table class="table m-0 table-sm">

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

         </table>
       </div>

       <div class="row invoice-sales-total-wrapper mt-3">
         <!-- <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
      <p class="card-text mb-0"><span class="fw-bold">Salesperson:</span> 
            <span class="ms-75">
              <?php echo $activeuser = getLogname($ressale['username']);
              if ($activeuser == "") {
                echo $ressale['username'];
              }
              ?>
            </span>
      </p>
    </div> -->
         <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
           <div class="invoice-total-wrapper">
             <div class="invoice-total-item">
               <p class="invoice-total-title">Subtotal: <?php echo $ressale['totalprice']; ?></p>
             </div>
             <div class="invoice-total-item">
               <p class="invoice-total-title">Discount:0.00</p>
             </div>
             <!-- <div class="invoice-total-item">
          <p class="invoice-total-title">Tax:0.00</p>
        </div> -->
             <hr class="my-50">
             <div class="invoice-total-item">
               <p class="invoice-total-title">Total: <strong>GHC <?php echo $ressale['totalprice']; ?></strong></p>
               <p><small>Total price includes VAT, NHIL and all expected taxes</small></p>
             </div>
           </div>
         </div>
       </div>


     </div>


     <div class="row mt-1">
       <div class="col-sm-12 text-align"></div>
       <div class="col-sm-12 text-align">
         <button type="button" id="paybtn" onclick="printContent('printthis')" class="btn btn-block btn-primary">Print</button>
       </div>
     </div>