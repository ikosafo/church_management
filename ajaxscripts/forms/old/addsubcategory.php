<?php
include ('../../config.php');
?>
<p class="card-text font-small mb-2">
    Add subcategory
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
                    <input type="text" id="subcategoryname" autocomplete="off" class="form-control" 
                        placeholder="Subcategory Name" />
                </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="subcategorycode">Subcategory Code</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="subcategorycode" autocomplete="off" class="form-control" 
                        placeholder="Subcategory Code" />
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
                        <?php
                        $getparentcat = $mysqli->query("select * from categories where status IS NULL");
                        while ($resparentcat = $getparentcat->fetch_assoc()) { ?>
                            <option value="<?php echo $resparentcat['catid'] ?>"><?php echo $resparentcat['categoryname'] ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                </div>
            </div>
            
            <div class="col-sm-9 offset-sm-3">
                <button type="button" id="subcategorybtn" class="btn btn-primary me-1">Submit</button>
            </div>
            </div>
 </form>



<script>
    //Jquery plugins
    $("#parentcategory").select2({
        placeholder: "Select parent category",
        allowClear: true
    });

     // Add action on form submit
     $("#subcategorybtn").click(function(){
        
      var subcategoryname = $("#subcategoryname").val();
      var subcategorycode = $("#subcategorycode").val();
      var parentcategory = $("#parentcategory").val();

      var error = '';
      if (subcategoryname == "") {
          error += 'Please enter subcategory name \n';
          $("#subcategoryname").focus();
      }
      if (subcategorycode == "") {
          error += 'Please enter subcategory code \n';
          $("#subcategorycode").focus();
      }
      if (parentcategory == "") {
          error += 'Please select parent category \n';
          $("#parentcategory").focus();
      }
      
      if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/subcategory.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    subcategoryname: subcategoryname,
                    subcategorycode: subcategorycode,
                    parentcategory:parentcategory
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

</script>