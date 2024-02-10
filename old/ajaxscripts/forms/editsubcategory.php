<?php
include ('../../config.php');
include ('../../functions.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from subcategories where subcatid = '$theid'");
$resdetails = $getdetails->fetch_assoc();

?>
<p class="card-text font-small mb-2">
    Edit category
</p>
<hr/>
<form class="form form-horizontal">
            <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="subcategoryname">Subcategory Name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="subcategoryname" class="form-control" 
                        placeholder="Subcategory Name" value="<?php echo $resdetails['subcategoryname']; ?>"/>
                </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="subcategorycode">Subcategory Code</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="subcategorycode" class="form-control" 
                        placeholder="Subcategory Code"  value="<?php echo $resdetails['subcategorycode']; ?>"/>
                </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="parentcategory">Parent Category</label>
                </div>
                <div class="col-sm-9">
                    <select class="form-select" id="parentcategory">
                        <option></option>
                        <?php $categoryid = $resdetails['parentid'];
                              $categoryname = categoryName($categoryid);
                              $getparentcat = $mysqli->query("select * from categories WHERE status IS NULL");
                               while ($resparentcat = $getparentcat->fetch_assoc()) { ?>
                                <option <?php if (@$resparentcat['categoryname'] == $categoryname) echo "selected" ?>>
                                    <?php echo $resparentcat['categoryname'] ?>
                                </option>
                                <?php }
                        ?>
                    </select    
                </div>
                </div>
            </div>
            
            <div class="col-sm-9 offset-sm-3">
                <button type="button" id="editsubcategorybtn" class="btn btn-warning me-1">Edit</button>
                <button type="button" id="backtoform" class="btn btn-secondary me-1">Back to form</button>
            </div>
            </div>
 </form>



<script>
     //Jquery plugins
     $("#parentcategory").select2({
        placeholder: "Select parent category",
        allowClear: true
    });

    // Edit action on form submit
     $("#editsubcategorybtn").click(function(){
     
      var subcategoryname = $("#subcategoryname").val();
      var subcategorycode = $("#subcategorycode").val();
      var parentcategory = $("#parentcategory").val();
      var theid = '<?php echo $theid ?>';

      var error = '';
      if (subcategoryname == "") {
          error += 'Please enter category name \n';
          $("#subcategoryname").focus();
      }
      if (subcategorycode == "") {
          error += 'Please enter category code \n';
          $("#subcategorycode").focus();
      }
     
      if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/subcategory.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    subcategoryname: subcategoryname,
                    subcategorycode: subcategorycode,
                    parentcategory: parentcategory,
                    theid:theid
                },
                success: function (text) {
                    //alert(text);
            
                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addsubcategory.php",
                            beforeSend: function () {
                                $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                            },
                            success: function (text) {
                                $('#pageform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                        $.ajax({
                            url: "ajaxscripts/tables/subcategories.php",
                            beforeSend: function () {
                                $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                            },
                            success: function (text) {
                                $('#pagetable_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });
                    }
                    else {
                      $("#error_loc").notify("Name or Code already exists", {position: "right"});
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },
            });
        }
        else {
            $("#error_loc").notify(error, {position: "right"});
        }
        return false;

    });


    //Back to form button click
    $("#backtoform").click(function(){
        $.ajax({
            url: "ajaxscripts/forms/addsubcategory.php",
            beforeSend: function () {
                $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
            },
            success: function (text) {
                $('#pageform_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },

        });
    });

</script>