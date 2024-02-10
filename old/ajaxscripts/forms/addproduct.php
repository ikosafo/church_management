<?php
include('../../config.php');
$random = rand(1, 10) . date("Y-m-d");
?>

<style>
  datalist {
    position: absolute;
    max-height: 20em;
    border: 0 none;
    overflow-x: hidden;
    overflow-y: auto;
  }

  datalist option {
    font-size: 0.8em;
    padding: 0.3em 1em;
    background-color: #ccc;
    cursor: pointer;
  }

  datalist option:hover,
  datalist option:focus {
    color: #fff;
    background-color: #036;
    outline: 0 none;
  }
</style>


<form autocomplete="off">

  <div class="row">
    <div class="mb-1 col-md-4">
      <label class="form-label">Product Sale Type</label> <br />
      <div>
        <span>
          <input class="form-check-input" type="radio" name="saletype" id="wholesale" value="wholesale" checked>
          <label class="form-check-label" for="wholesale">Wholesale</label>
        </span>
        <span style="margin-left: 20px;">
          <input class="form-check-input ml-4" type="radio" name="saletype" id="retail" value="retail">
          <label class="form-check-label" for="retail">Retail</label>
        </span>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="mb-1 col-md-4">
      <label class="form-label" for="productname">Product Name</label>
      <input type="text" id="productname" class="form-control" placeholder="Product Name" />
    </div>
    <div class="mb-1 col-md-4">
      <label class="form-label" for="quantity">Quantity</label>
      <input type="text" id="quantity" class="form-control" onkeypress="return isNumber(event)" placeholder="Quantity" />
    </div>
    <div class="mb-1 col-md-4">
      <label class="form-label" for="stockthreshold">Low stock threshold</label>
      <input type="text" id="stockthreshold" onkeypress="return isNumber(event)" class="form-control" placeholder="Low stock threshold" />
    </div>
  </div>

  <div class="row">
    <div class="mb-1 col-md-4">
      <label class="form-label" for="supplier">Supplier</label>
      <input list="suppliers" id="supplier" class="form-control" placeholder="Enter or select a supplier" />
      <datalist id="suppliers">
        <?php
        $suppliers = array();

        $getsupplier = $mysqli->query("SELECT * FROM supplier WHERE status IS NULL");
        while ($ressupplier = $getsupplier->fetch_assoc()) {
          $suppliers[] = $ressupplier['fullname'] . ' - ' . $ressupplier['companyname'];
        }

        $getsupplierdb = $mysqli->query("SELECT DISTINCT supplier FROM products");
        while ($ressupplierdb = $getsupplierdb->fetch_assoc()) {
          $suppliers[] = $ressupplierdb['supplier'];
        }

        // Custom sorting function to sort in a case-insensitive manner
        function caseInsensitiveSort($a, $b)
        {
          return strcasecmp($a, $b);
        }

        // Sort the array using the custom sorting function
        usort($suppliers, 'caseInsensitiveSort');

        // Print the sorted options
        foreach ($suppliers as $supplier) {
          echo '<option>' . htmlspecialchars($supplier) . '</option>';
        }
        ?>
      </datalist>
    </div>
    <div class="mb-1 col-md-4">
      <label class="form-label" for="expirydate">Expiry Date</label>
      <input type="text" id="expirydate" class="form-control" placeholder="Expiry Date" />
    </div>
    <div class="mb-1 col-md-4">
      <label class="form-label" for="variations">Variations</label>
      <input type="text" id="variations" class="form-control" placeholder="Specify Variations" />
    </div>
    <div class="mb-1 col-md-4">
      <label class="form-label" for="sellingprice">Selling Price </label>
      <input type="text" id="sellingprice" oninput="updateReadOnlyBox()" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Selling Price" />
    </div>
    <div class="mb-1 col-md-4">
      <label class="form-label" for="costprice">Cost Price</label>
      <input type="text" id="costprice" readonly onkeypress="return isNumberKey(event)" class="form-control" placeholder="Cost Price" />
    </div>

  </div>

  <div class="d-flex justify-content-between mt-2">
    <button class="btn btn-outline-secondary btn-prev waves-effect" disabled="">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-sm-25 me-0">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
      </svg>
      <span class="align-middle d-sm-inline-block d-none">Previous</span>
    </button>
    <button id="productinfobtn" class="btn btn-primary waves-effect waves-float waves-light">
      <span class="align-middle d-sm-inline-block d-none">Next</span>
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ms-sm-25 ms-0">
        <line x1="5" y1="12" x2="19" y2="12"></line>
        <polyline points="12 5 19 12 12 19"></polyline>
      </svg>
    </button>
  </div>

</form>


<script>
  $("#expirydate").flatpickr();

  function updateReadOnlyBox() {
    // Get the value from the inputBox
    var inputBoxValue = document.getElementById("sellingprice").value;

    // Parse the value as a number
    var numberValue = parseFloat(inputBoxValue);
    var costPrice = numberValue * 0.9;
    document.getElementById("costprice").value = isNaN(costPrice) ? "" : costPrice.toFixed(2);;
  }

  //PRODUCT INFORMATION
  $("#productinfobtn").on("click", (function() {

    var productname = $("#productname").val();
    var quantity = $("#quantity").val();
    var stockthreshold = $("#stockthreshold").val();
    var supplier = $("#supplier").val();
    var expirydate = $("#expirydate").val();
    var variations = $("#variations").val();
    var costprice = $("#costprice").val();
    var sellingprice = $("#sellingprice").val();
    var saletype = $('input[name=saletype]:checked').val();
    var random = '<?php echo $random; ?>';

    var error = '';

    if (productname == "") {
      error += 'Please enter product name \n';
      $("#productname").focus();
    }
    if (quantity == "") {
      error += 'Please enter quantity \n';
      $("#quantity").focus();
    }
    if (stockthreshold == "") {
      error += 'Please enter threshold \n';
      $("#stockthreshold").focus();
    }
    if (supplier == "") {
      error += 'Please enter or select supplier \n';
      $("#supplier").focus();
    }
    if (variations == "") {
      error += 'Please specify variations \n';
      $("#variations").focus();
    }
    if (sellingprice == "") {
      error += 'Please enter selling price \n';
      $("#sellingprice").focus();
    }

    if (error == "") {
      $.ajax({
        type: "POST",
        url: "ajaxscripts/queries/save/product.php",
        beforeSend: function() {
          $.blockUI({
            message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
          });
        },
        data: {
          productname,
          quantity,
          stockthreshold,
          supplier,
          expirydate,
          variations,
          costprice,
          sellingprice,
          saletype,
          random
        },
        success: function(text) {
          //alert(text);

          if (text == 1) {
            $.notify("Product Saved", "success", {
              position: "top center"
            });
            $.ajax({
              url: "ajaxscripts/forms/productsummary.php",
              success: function(text) {
                $('#productsummarydiv').html(text);
              },
              error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
              },
            });
            var stepper = new Stepper(document.querySelector('.bs-stepper'))
            stepper.to(2);
          } else {
            $.notify("Product alredy exists", "error", {
              position: "top center"
            });
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
      $.notify(error, {
        position: "top center"
      });
    }
    return false;

  }))
</script>