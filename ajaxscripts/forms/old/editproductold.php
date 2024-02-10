<?php
include('../../config.php');
include('../../functions.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from products where prodid = '$theid'");
$resdetails = $getdetails->fetch_assoc();

?>
<p class="card-text font-small mb-2">
    Edit Product
</p>
<hr />
<section class="horizontal-wizard" id="error_loc">
    <div class="bs-stepper horizontal-wizard-example">
        <div class="bs-stepper-header" role="tablist">
            <div class="step" data-target="#product-details" role="tab" id="product-details-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">1</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Product Details</span>
                        <span class="bs-stepper-subtitle">Add Product Details</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#categories-variations" role="tab" id="categories-variations-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Categories & Variations</span>
                        <span class="bs-stepper-subtitle">Add Categories and Variations</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#pricing-step" role="tab" id="pricing-step-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">3</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Pricing</span>
                        <span class="bs-stepper-subtitle">Add Pricing</span>
                    </span>
                </button>
            </div>

        </div>
        <div class="bs-stepper-content">
            <div id="product-details" class="content" role="tabpanel" aria-labelledby="product-details-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Product Information</h5>
                    <small class="text-muted">Enter Your Product Details</small>
                </div>
                <form>
                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label">Product Sale Type</label> <br />
                            <div>
                                <span>
                                    <input class="form-check-input" type="radio" name="saletype" id="wholesale" value="wholesale" <?php if (@$resdetails['salestatus'] == "wholesale") echo "checked" ?>>
                                    <label class="form-check-label" for="wholesale">Wholesale</label>
                                </span>
                                <span style="margin-left: 20px;">
                                    <input class="form-check-input ml-4" type="radio" name="saletype" id="retail" value="retail" <?php if (@$resdetails['salestatus'] == "retail") echo "checked" ?>>
                                    <label class="form-check-label" for="retail">Retail</label>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="barcode">Barcode</label>
                            <input type="text" id="barcode" name="barcode" class="form-control" placeholder="Barcode" autocomplete="off" value="<?php echo $resdetails['barcode']; ?>" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="productname">Product Name</label>
                            <input type="text" id="productname" name="productname" class="form-control" placeholder="Product Name" value="<?php echo $resdetails['productname']; ?>" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="quantitysale">Quantity (In Stock)</label>
                            <input type="text" id="quantitysale" name="quantitysale" class="form-control" onkeypress="return isNumber(event)" placeholder="Quantity (For Sale)" value="<?php echo $resdetails['quantitysale']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="quantitystock">Quantity (In Warehouse)</label>
                            <input type="text" id="quantitystock" name="quantitystock" class="form-control" onkeypress="return isNumber(event)" placeholder="Quantity (In Stock)" value="<?php echo $resdetails['quantitystock']; ?>" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="stockthreshold">Low stock threshold</label>
                            <input type="text" id="stockthreshold" name="stockthreshold" onkeypress="return isNumber(event)" class="form-control" placeholder="Low stock threshold" value="<?php echo $resdetails['stockthreshold']; ?>" s />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="sku">SKU (Stock Keeping Unit)</label>
                            <input type="text" id="sku" name="sku" class="form-control" placeholder="SKU" value="<?php echo $resdetails['sku']; ?>" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="supplier">Supplier</label>

                            <input list="suppliers" id="supplier" value="<?php echo $resdetails['supplier'] ?>" name="supplier" class="form-control" placeholder="Enter or select a supplier" />
                            <datalist id="suppliers">
                                <?php
                                $getsupplier = $mysqli->query("select * from supplier where status IS NULL");
                                while ($ressupplier = $getsupplier->fetch_assoc()) { ?>
                                    <option>
                                        <?php echo $ressupplier['fullname'] . ' - ' . $ressupplier['companyname']; ?>
                                    </option>
                                <?php } ?>
                            </datalist>

                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="expirydate">Expiry Date</label>
                            <input type="text" id="expirydate" name="expirydate" class="form-control" placeholder="Expiry Date" value="<?php echo $resdetails['expirydate']; ?>" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="isbn">UPC/EAN/ISBN</label>
                            <input type="text" id="isbn" name="isbn" class="form-control" placeholder="UPC/EAN/ISBN" value="<?php echo $resdetails['isbn']; ?>" />
                        </div>

                    </div>

                </form>

                <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-secondary btn-prev" disabled>
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>
            <div id="categories-variations" class="content" role="tabpanel" aria-labelledby="categories-variations-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Categories & Variations</h5>
                    <small>Enter categories and variations</small>
                </div>
                <form>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="category">Category</label>
                            <select id="category" name="category" class="form-select">
                                <option></option>
                                <?php
                                $categoryid = $resdetails['category'];
                                $getcategory = $mysqli->query("select * from categories where status IS NULL");
                                while ($rescategory = $getcategory->fetch_assoc()) { ?>
                                    <option value="<?php echo $rescategory['catid'] ?>" <?php if (@$rescategory['catid'] == $categoryid) echo "selected" ?>>
                                        <?php echo $rescategory['categoryname']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="subcategory">Subcategory</label>
                            <select id="subcategory" name="subcategory" class="form-select">
                                <option></option>
                                <?php
                                $subcategory = $resdetails['subcategory'];
                                $category = $resdetails['category'];

                                $query = $mysqli->query("select * from subcategories where parentid = '$category' and status IS NULL");
                                while ($result = $query->fetch_assoc()) { ?>
                                    <option value="<?php echo $result['subcatid'] ?>" <?php if (@$subcategory == $result['subcatid']) echo "Selected" ?>><?php echo $result['subcategoryname'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="variation1">Variation 1</label>
                            <select id="variation1" name="variation1" class="form-select">
                                <option></option>
                                <?php
                                $variation1id = $resdetails['variation1'];
                                $getvariation1 = $mysqli->query("select * from variations where status IS NULL");
                                while ($resvariation1 = $getvariation1->fetch_assoc()) { ?>
                                    <option value="<?php echo $resvariation1['varid'] ?>" <?php if (@$resvariation1['varid'] == $variation1id) echo "selected" ?>>
                                        <?php echo $resvariation1['attributename']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="variation1spec">Specify Variation 1</label>
                            <input type="text" id="variation1spec" name="variation1spec" class="form-control" placeholder="Specify Variation 1" value="<?php echo $resdetails['variation1spec']; ?>" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="variation2">Variation 2</label>
                            <select id="variation2" name="variation2" class="form-select">
                                <option></option>
                                <?php
                                $variation2id = $resdetails['variation2'];
                                $getvariation2 = $mysqli->query("select * from variations where status IS NULL");
                                while ($resvariation2 = $getvariation2->fetch_assoc()) { ?>
                                    <option value="<?php echo $resvariation2['varid'] ?>" <?php if (@$resvariation2['varid'] == $variation2id) echo "selected" ?>>
                                        <?php echo $resvariation2['attributename']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="variation2spec">Specify Variation 2</label>
                            <input type="text" id="variation2spec" name="variation2spec" class="form-control" placeholder="Specify Variation 2" value="<?php echo $resdetails['variation2spec']; ?>" />
                        </div>

                    </div>
                    <div class="row">

                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="variation3">Variation 3</label>
                            <select id="variation3" name="variation3" class="form-select">
                                <option></option>
                                <?php
                                $variation3id = $resdetails['variation3'];
                                $getvariation3 = $mysqli->query("select * from variations where status IS NULL");
                                while ($resvariation3 = $getvariation3->fetch_assoc()) { ?>
                                    <option value="<?php echo $resvariation3['varid'] ?>" <?php if (@$resvariation3['varid'] == $variation3id) echo "selected" ?>>
                                        <?php echo $resvariation3['attributename']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="variation3spec">Specify Variation 3</label>
                            <input type="text" id="variation3spec" name="variation3spec" class="form-control" placeholder="Specify Variation 3" value="<?php echo $resdetails['variation3spec']; ?>" />
                        </div>
                    </div>

                </form>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev">
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>
            <div id="pricing-step" class="content" role="tabpanel" aria-labelledby="pricing-step-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Pricing</h5>
                    <small>Enter the pricing details</small>
                </div>
                <form>
                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="costprice">Cost Price</label>
                            <input type="text" id="costprice" onkeypress="return isNumberKey(event)" name="costprice" class="form-control" value="<?php echo $resdetails['costprice']; ?>" placeholder="Cost Price" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="sellingpricewhole">Selling Price (Wholesale)</label>
                            <input type="text" id="sellingpricewhole" onkeypress="return isNumberKey(event)" name="sellingpricewhole" class="form-control" value="<?php echo $resdetails['sellingpricewhole']; ?>" placeholder="Selling Price (Wholesale)" />
                        </div>

                    </div>

                </form>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev">
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-warning btn-submit">Update</button>
                </div>
            </div>

        </div>
    </div>
</section>

<button type="button" id="backtoproducts" class="btn btn-outline-primary waves-effect">Back to products</button>


<script>
    $("#backtoproducts").click(function() {
        window.location.href = "/viewproducts";
    })


    // Page jquery scripts
    $("#expirydate").flatpickr();
    /* $("#supplier").select2({
      placeholder: "Select supplier",
      allowClear: true
    }); */
    $("#category").select2({
        placeholder: "Select category",
        allowClear: true
    });
    $("#subcategory").select2({
        placeholder: "Select subcategory",
        allowClear: true
    });
    $("#variation1").select2({
        placeholder: "Select Variation 1",
        allowClear: true
    });
    $("#variation2").select2({
        placeholder: "Select Variation 2",
        allowClear: true
    });
    $("#variation3").select2({
        placeholder: "Select Variation 3",
        allowClear: true
    });

    $("#category").change(function() {
        var category = $(this).val();
        if (category != "") {
            $.ajax({
                url: "ajaxscripts/forms/geteditsubcategoryid.php",
                data: {
                    category: category
                },
                type: 'POST',
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                success: function(response) {
                    var resp = $.trim(response);
                    $("#subcategory").html(resp);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                    $.unblockUI();
                },
            });
        } else {
            $("#subcategory").html("<option value=''></option>");
        }
    });


    // Add action on form submit
    $(function() {
        "use strict";
        var e = document.querySelectorAll(".bs-stepper"),
            n = $(".select2"),
            i = document.querySelector(".horizontal-wizard-example"),
            r = document.querySelector(".vertical-wizard-example"),
            t = document.querySelector(".modern-wizard-example"),
            o = document.querySelector(".modern-vertical-wizard-example");
        if (void 0 !== typeof e && null !== e)
            for (var l = 0; l < e.length; ++l)
                e[l].addEventListener("show.bs-stepper", function(e) {
                    for (var n = e.detail.indexStep, i = $(e.target).find(".step").length - 1, r = $(e.target).find(".step"), t = 0; t < n; t++) {
                        r[t].classList.add("crossed");
                        for (var o = n; o < i; o++) r[o].classList.remove("crossed");
                    }
                    if (0 == e.detail.to) {
                        for (var l = n; l < i; l++) r[l].classList.remove("crossed");
                        r[0].classList.remove("crossed");
                    }
                });
        if (
            (n.each(function() {
                    var e = $(this);
                    e.wrap('<div class="position-relative"></div>');
                }),
                void 0 !== typeof i && null !== i)
        ) {
            var d = new Stepper(i);
            $(i)
                .find("form")
                .each(function() {
                    $(this).validate({
                        rules: {
                            /*   barcode: {
                                required: !0
                              }, */
                            productname: {
                                required: !0
                            },
                            quantitysale: {
                                required: !0
                            },
                            quantitystock: {
                                required: !0
                            },
                            stockthreshold: {
                                required: !0
                            },
                            supplier: {
                                required: !0
                            },
                            category: {
                                required: !0
                            },
                            subcategory: {
                                required: !0
                            },
                            variation1: {
                                required: !0
                            },
                            variation1spec: {
                                required: !0
                            },
                            costprice: {
                                required: !0
                            },
                            sellingpricewhole: {
                                required: !0
                            },


                        },
                    });
                }),
                $(i)
                .find(".btn-next")
                .each(function() {
                    $(this).on("click", function(e) {
                        //alert('test')
                        $(this).parent().siblings("form").valid() ? d.next() : e.preventDefault();
                    });
                }),
                $(i)
                .find(".btn-prev")
                .on("click", function() {
                    d.previous();
                }),
                $(i)
                .find(".btn-submit")
                .on("click", function() {
                    var barcode = $("#barcode").val();
                    var productname = $("#productname").val();
                    var quantitysale = $("#quantitysale").val();
                    var quantitystock = $("#quantitystock").val();
                    var stockthreshold = $("#stockthreshold").val();
                    var sku = $("#sku").val();
                    var supplier = $("#supplier").val();
                    var expirydate = $("#expirydate").val();
                    var isbn = $("#isbn").val();
                    var category = $("#category").val();
                    var subcategory = $("#subcategory").val();
                    var variation1 = $("#variation1").val();
                    var variation1spec = $("#variation1spec").val();
                    var variation2 = $("#variation2").val();
                    var variation2spec = $("#variation2spec").val();
                    var variation3 = $("#variation3").val();
                    var variation3spec = $("#variation3spec").val();
                    var costprice = $("#costprice").val();
                    var sellingpricewhole = $("#sellingpricewhole").val();
                    var saletype = $('input[name=saletype]:checked').val();
                    var theindex = '<?php echo $theid ?>';

                    //alert(supplier);
                    var error = '';
                    if (costprice == "") {
                        error += 'Please enter costprice \n';
                        $("#costprice").focus();
                    }
                    /* if (costprice > sellingpricewhole) {
                      error += 'Please enter a valid selling price \n';
                      $("#sellingpricewhole").focus();
                    } */
                    if (sellingpricewhole == "") {
                        error += 'Please enter sellingprice \n';
                        $("#sellingpricewhole").focus();
                    }
                    if (variation1 == variation2) {
                        error += 'Please select different variations \n';
                    }
                    if (variation1 == variation3) {
                        error += 'Please select different variations \n';
                    }
                    if (variation2 != "" && (variation2 == variation3)) {
                        error += 'Please select different variations \n';
                    }
                    if (variation2 != "" && variation2spec == "") {
                        error += 'Please specify second variation \n';
                        $("#variation2spec").focus();
                    }
                    if (variation2spec != "" && variation2 == "") {
                        error += 'Please select second variation \n';
                    }
                    if (variation3 != "" && variation3spec == "") {
                        error += 'Please specify third variation \n';
                        $("#variation3spec").focus();
                    }
                    if (variation3spec != "" && variation3 == "") {
                        error += 'Please select third variation \n';
                    }


                    if (error == "") {
                        $(this).parent().siblings("form").valid() && $.notify("Edited..!!", "success");
                        $.ajax({
                            type: "POST",
                            url: "ajaxscripts/queries/edit/product.php",
                            beforeSend: function() {
                                $.blockUI({
                                    message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                                });
                            },
                            data: {
                                barcode: barcode,
                                productname: productname,
                                quantitysale: quantitysale,
                                quantitystock: quantitystock,
                                stockthreshold: stockthreshold,
                                sku: sku,
                                supplier: supplier,
                                expirydate: expirydate,
                                isbn: isbn,
                                category: category,
                                subcategory: subcategory,
                                variation1: variation1,
                                variation1spec: variation1spec,
                                variation2: variation2,
                                variation2spec: variation2spec,
                                variation3: variation3,
                                variation3spec: variation3spec,
                                costprice: costprice,
                                sellingpricewhole: sellingpricewhole,
                                theindex: theindex,
                                saletype: saletype
                            },
                            success: function(text) {
                                //alert(text);

                                if (text == 1) {
                                    //Load user form
                                    $.ajax({
                                        url: "ajaxscripts/forms/addproduct.php",
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

                                    window.location.href = "/viewproducts";

                                } else {
                                    $.notify("Barcode already exists");
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
                        $.notify(error);
                    }
                    return false;



                });
        }


    });
</script>