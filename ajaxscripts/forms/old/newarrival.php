<?php include('../../config.php'); ?>

<p class="card-text">
    Field marked <span style="color:red">*</span> required </p>
<form class="form form-horizontal" autocomplete="off">
    <div id="error_loc"></div>
    <div class="row">

        <div class="mb-1 col-md-4">
            <label class="form-label" for="product">Product <span style="color:red">*</span></label>
            <select id="product" class="form-select">
                <option></option>
                <?php
                $getproduct = $mysqli->query("select * from products where status IS NULL");
                while ($resproduct = $getproduct->fetch_assoc()) { ?>
                    <option value="<?php echo $resproduct['prodid'] ?>">
                        <?php echo $resproduct['productname'] . " - " . strtoupper($resproduct['salestatus']); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="quantity">Quantity <span style="color:red">*</span></label>
            <input type="text" id="quantity" class="form-control" onkeypress="return isNumber(event)" placeholder="Quantity (For Sale)" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="supplier">Supplier <span style="color:red">*</span></label>

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


    </div>
    <div class="row">

        <div class="mb-1 col-md-4">
            <label class="form-label" for="expirydate">Expiry Date</label>
            <input type="text" id="expirydate" class="form-control" placeholder="Expiry Date" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="sellingprice">Selling Price</label>
            <input type="text" id="sellingprice" oninput="updateReadOnlyBox()" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Selling Price" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="costprice">Cost Price</label>
            <input type="text" readonly id="costprice" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Cost Price" />
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12 offset-sm-12">
            <button type="button" id="arrivalbtn" class="btn btn-primary me-1">Submit</button>
        </div>
    </div>

</form>

<script>
    // Page jquery scripts
    $("#expirydate").flatpickr();

    $("#product").select2({
        placeholder: "Select product",
        allowClear: true
    });

    function updateReadOnlyBox() {
        // Get the value from the inputBox
        var inputBoxValue = document.getElementById("sellingprice").value;

        // Parse the value as a number
        var numberValue = parseFloat(inputBoxValue);
        var costPrice = numberValue * 0.9;
        document.getElementById("costprice").value = isNaN(costPrice) ? "" : costPrice.toFixed(2);;
    }


    // Add action on form submit
    $("#arrivalbtn").click(function() {

        var product = $("#product").val();
        var quantity = $("#quantity").val();
        var supplier = $('#supplier').val();
        var expirydate = $("#expirydate").val();
        var costprice = $("#costprice").val();
        var sellingprice = $("#sellingprice").val();

        var error = '';
        if (product == "") {
            error += 'Please select product \n';
        }
        if (quantity == "") {
            error += 'Please enter quantity for sale \n';
            $("#quantity").focus();
        }
        if (supplier == "") {
            error += 'Please enter or select supplier \n';
        }
        if (sellingprice == "") {
            error += 'Please enter selling price \n';
            $("#sellingprice").focus();
        }

        if (error == "") {
            $.confirm({
                title: 'Save Record!',
                content: 'Are you sure to continue? This is not reversible',
                buttons: {
                    no: {
                        text: 'No',
                        keys: ['enter', 'shift'],
                        backdrop: 'static',
                        keyboard: false,
                        action: function() {
                            $.alert('Data is safe');
                        }
                    },
                    yes: {
                        text: 'Yes, Save it!',
                        btnClass: 'btn-blue',
                        action: function() {
                            $.ajax({
                                type: "POST",
                                url: "ajaxscripts/queries/save/newarrivals.php",
                                beforeSend: function() {
                                    $.blockUI({
                                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                                    });
                                },
                                data: {
                                    product,
                                    quantity,
                                    supplier,
                                    expirydate,
                                    costprice,
                                    sellingprice
                                },
                                success: function(text) {
                                    //alert(text);
                                    $.ajax({
                                        url: "ajaxscripts/forms/newarrival.php",
                                        beforeSend: function() {
                                            $.blockUI({
                                                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                                            });
                                        },
                                        success: function(text) {
                                            $('#pageform_div').html(text);
                                        },
                                        error: function(xhr, ajaxOptions, thrownError) {
                                            alert(xhr.status + " " + thrownError);
                                        },
                                        complete: function() {
                                            $.unblockUI();
                                        },

                                    });
                                    window.location.href = "/viewnewarrivals";
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                },
                                complete: function() {
                                    $.unblockUI();
                                },
                            });
                        }
                    }
                }
            });

        } else {
            $.notify(error, "error", {
                position: "top-center"
            });
        }
        return false;
    });
</script>