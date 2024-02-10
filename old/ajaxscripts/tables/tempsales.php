<?php
include('../../config.php');
include('../../functions.php');
$getnewsaleid = date('Ymdhis') . rand(1, 20);

$newsaleid = $_POST['newsaleid'];
$gettemp = $mysqli->query("select * from tempsales where genid = '$newsaleid'");

if (mysqli_num_rows($gettemp) == "0") {
  echo "";
} else { ?>

  <style>
    .tempsales_table td {
      font-size: 14px;
    }
  </style>
  <div class="table-responsive">
    <table class="table table-sm tempsales_table">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Selling Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($restemp = $gettemp->fetch_assoc()) { ?>
          <tr>
            <td>
              <?php
              $prodid = $restemp['prodid'];
              echo getProductName($prodid); ?>
            </td>
            <td>
              <div class="form-group input-group input-group-lg ui-badge cart-item-count">
                <input id="product<?php echo $restemp['tsid']; ?>" type="text" i_index="<?php echo $restemp['tsid']; ?>" value="<?php echo $quantity =  $restemp['quantity']; ?>" name="quantity" class="form-control input-lg updatequantity" autocomplete="off" />
              </div>
            </td>
            <td>
              <?php echo "GHC " . $restemp['price'] ?>
            </td>
            <td>
              <div class="text-center">
                <a class="deletetempsales" title="Delete" i_index="<?php echo $restemp['tsid']; ?>">
                  <span class="icon-wrapper cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                      <polyline points="3 6 5 6 21 6"></polyline>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                      <line x1="10" y1="11" x2="10" y2="17"></line>
                      <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                  </span>
                </a>
              </div>
            </td>
          </tr>
        <?php }
        ?>
        <tr>
          <td colspan="2"><b>TOTAL</b></td>
          <td colspan="2">
            <?php
            //get the total
            $getsum = $mysqli->query("select sum(price) as totprice from tempsales where genid = '$newsaleid'");
            $ressum = $getsum->fetch_assoc();
            $totalprice = $ressum['totprice'];
            $format = number_format($totalprice, 2);
            echo "<b>GHC " . $format . '</b>';
            ?>
          </td>
        </tr>

      </tbody>
    </table>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="mb-1 mt-5 row">
        <div class="col-sm-3">
          <label class="col-form-label" for="amountpaid">Amount Paid</label>
        </div>
        <div class="col-sm-9">
          <input type="text" onkeypress="return isNumberKey(event)" id="amountpaid" class="form-control" autocomplete="off" placeholder="Enter amount paid" />
        </div>
      </div>
      <div class="mb-1 row">
        <div class="col-sm-3">
          <label class="col-form-label" for="change">Change</label>
        </div>
        <div class="col-sm-9">
          <input type="text" readonly id="change" class="form-control" autocomplete="off" placeholder="Change" />
        </div>
      </div>
      <div class="mb-1 row">
        <div class="col-sm-3">
          <label class="col-form-label" for="customer">Customer</label>
        </div>

        <div class="col-sm-9">
          <input list="customers" id="customer" class="form-control" placeholder="Enter or select a customer" />
          <datalist id="customers">
            <?php
            $customers = array();

            $getcustomer = $mysqli->query("SELECT * FROM customer WHERE status IS NULL");
            while ($rescustomer = $getcustomer->fetch_assoc()) {
              $customers[] = $rescustomer['fullname'];
            }

            $getcustomerdb = $mysqli->query("SELECT DISTINCT customer FROM sales");
            while ($rescustomerdb = $getcustomerdb->fetch_assoc()) {
              $customers[] = $rescustomerdb['customer'];
            }

            // Custom sorting function to sort in a case-insensitive manner
            function caseInsensitiveSort($a, $b)
            {
              return strcasecmp($a, $b);
            }

            // Sort the array using the custom sorting function
            usort($customers, 'caseInsensitiveSort');

            // Print the sorted options
            foreach ($customers as $customer) {
              echo '<option>' . htmlspecialchars($customer) . '</option>';
            }
            ?>
          </datalist>
        </div>
      </div>
      <div class="mb-1 row">
        <div class="col-sm-3">
          <label class="col-form-label" for="customertel">Telephone</label>
        </div>
        <div class="col-sm-9">
          <input type="text" id="customertel" class="form-control" autocomplete="off" placeholder="Enter telephone" />
        </div>
      </div>

      <div class="mb-1 row">
        <div class="col-sm-3">
          <label class="col-form-label" for="paymentmethod">Payment Method</label>
        </div>
        <div class="col-sm-9">
          <select id="paymentmethod" class="form-select">
            <option value='Cash'>Cash</option>
            <option value='Card'>Card</option>
            <option value='Mobile Money'>Mobile Money</option>
            <option value='other'>Other</option>
          </select>
        </div>
      </div>

      <div class="row mt-1">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
          <button type="button" id="paybtn" class="btn btn-block btn-block btn-primary">Pay and print receipt</button>
        </div>
      </div>
    </div>
  </div>

<?php }
?>


<script>
  $("#paymentmethod").select2({
    placeholder: "Select Payment Method",
    allowClear: true
  });

  $('#amountpaid').keyup(function() {
    var amountpaid = $('#amountpaid').val();
    var totalprice = '<?php echo $totalprice; ?>';
    var change = amountpaid - totalprice;
    $('#change').val(change.toFixed(2));
  });

  $("input[name='quantity']").TouchSpin({
    max: 100,
    min: 1,
    step: 1
  });

  $("#paybtn").click(function() {
    var amountpaid = $('#amountpaid').val();
    var totalprice = '<?php echo $totalprice; ?>';
    var change = $('#change').val();
    var customer = $('#customer').val();
    var paymentmethod = $('#paymentmethod').val();
    var customertel = $('#customertel').val();

    var error = '';

    if (amountpaid == "") {
      error += 'Enter amount paid \n';
      $("#amountpaid").focus();
    }
    if (customer == "") {
      error += 'Enter enter shop name \n';
      $("#customer").focus();
    }
    if (change < 0) {
      error += 'Amount paid is insufficient \n';
      $("#amountpaid").focus();
    }

    if (error == "") {
      $.ajax({
        type: "POST",
        url: "ajaxscripts/queries/save/sales.php",
        beforeSend: function() {
          $.blockUI({
            message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
          });
        },
        data: {
          amountpaid: amountpaid,
          totalprice: totalprice,
          change: change,
          newsaleid: '<?php echo $newsaleid; ?>',
          customer: customer,
          paymentmethod: paymentmethod,
          customertel: customertel
        },
        success: function(text) {
          // Reload the current page
          //location.reload();
          //alert(text);

          if (text[0] == 2) {
            $.notify('There is an item with less quantities in stock', 'error', 'top center');
          } else if (text[0] == '1') {
            // Create a form dynamically
            var form = $('<form action="ajaxscripts/queries/print/sales.php" method="POST"></form>');
            form.append('<input type="hidden" name="amountpaid" value="' + amountpaid + '">');
            form.append('<input type="hidden" name="totalprice" value="' + totalprice + '">');
            form.append('<input type="hidden" name="change" value="' + change + '">');
            form.append('<input type="hidden" name="newsaleid" value="' + '<?php echo $newsaleid; ?>' + '">');
            form.append('<input type="hidden" name="customer" value="' + customer + '">');
            form.append('<input type="hidden" name="paymentmethod" value="' + paymentmethod + '">');

            // Append the form to the body and submit it
            $('body').append(form);
            form.submit();
          }

        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + " " + thrownError);
        },
        complete: function() {
          $.unblockUI();
        },
      });

    } else {
      $("#error_loc").notify(error);
    }
    return false;

  });


  $("input[name='quantity']").on("touchspin.on.startspin", function() {
    var id_index = $(this).attr('i_index');
    var quantity = $("#product" + id_index).val();
    //alert(quantity);
    var newsaleid = '<?php echo $newsaleid; ?>';

    $.ajax({
      type: "POST",
      url: "ajaxscripts/queries/edit/tempsalesquantity.php",
      data: {
        id_index: id_index,
        quantity: quantity,
        newsaleid: newsaleid
      },
      dataType: "html",
      success: function(text) {
        //alert(text);
        if (text == 2) {
          $.notify('Quantity is more than in stock', 'error', 'top');
        } else {
          $.ajax({
            type: "POST",
            url: "ajaxscripts/tables/tempsales.php",
            data: {
              newsaleid: '<?php echo $newsaleid; ?>'
            },
            beforeSend: function() {
              $.blockUI({
                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
              });
            },
            success: function(text) {
              $('#pagetable_div').html(text);
            },
            error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + " " + thrownError);
            },
            complete: function() {
              $.unblockUI();
            },

          });
        }

      },
      complete: function() {},
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " " + thrownError);
      }
    });
  });

  $(document).on('keyup', '.updatequantity', function() {
    var id_index = $(this).attr('i_index');
    var quantity = $("#product" + id_index).val();
    //alert(quantity);
    var newsaleid = '<?php echo $newsaleid; ?>';

    $.ajax({
      type: "POST",
      url: "ajaxscripts/queries/edit/tempsalesquantity.php",
      data: {
        id_index: id_index,
        quantity: quantity,
        newsaleid: newsaleid
      },
      dataType: "html",
      success: function(text) {
        //alert(text);
        $.ajax({
          type: "POST",
          url: "ajaxscripts/tables/tempsales.php",
          data: {
            newsaleid: '<?php echo $newsaleid; ?>'
          },
          beforeSend: function() {
            $.blockUI({
              message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
            });
          },
          success: function(text) {
            $('#pagetable_div').html(text);
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
          },
          complete: function() {
            $.unblockUI();
          },
        });
      },
      complete: function() {},
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " " + thrownError);
      }
    });

  });


  //Delete sales after icon click
  $(document).off('click', '.deletetempsales').on('click', '.deletetempsales', function() {
    var theindex = $(this).attr('i_index');

    $.ajax({
      type: "POST",
      url: "ajaxscripts/queries/delete/tempsales.php",
      data: {
        i_index: theindex
      },
      dataType: "html",
      success: function(text) {
        $.ajax({
          type: "POST",
          url: "ajaxscripts/tables/tempsales.php",
          data: {
            newsaleid: '<?php echo $newsaleid; ?>'
          },
          beforeSend: function() {
            $.blockUI({
              message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
            });
          },
          success: function(text) {
            $('#pagetable_div').html(text);
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
          },
          complete: function() {
            $.unblockUI();
          },

        });
      },
      complete: function() {},
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + " " + thrownError);
      }
    });

  });
</script>