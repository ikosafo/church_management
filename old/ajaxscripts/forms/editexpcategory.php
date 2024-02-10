<?php
include ('../../config.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from expcategories where expcatid = '$theid'");
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
                    <label class="col-form-label" for="categoryname">Name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="categoryname" class="form-control" 
                        placeholder="Category Name" value="<?php echo $resdetails['categoryname']; ?>"/>
                </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="categorycode">Category Code</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="categorycode" class="form-control" 
                        placeholder="Category Code"  value="<?php echo $resdetails['categorycode']; ?>"/>
                </div>
                </div>
            </div>
            
            <div class="col-sm-9 offset-sm-3">
                <button type="button" id="editexpcategorybtn" class="btn btn-warning me-1">Edit</button>
                <button type="button" id="backtoform" class="btn btn-secondary me-1">Back to form</button>
            </div>
            </div>
 </form>



<script>

    // Edit action on form submit
     $("#editexpcategorybtn").click(function(){
     
      var categoryname = $("#categoryname").val();
      var categorycode = $("#categorycode").val();
      var theid = '<?php echo $theid ?>';

      var error = '';
      if (categoryname == "") {
          error += 'Please enter category name \n';
          $("#categoryname").focus();
      }
      if (categorycode == "") {
          error += 'Please enter category code \n';
          $("#categorycode").focus();
      }
      
      if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/expcategory.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    categoryname: categoryname,
                    categorycode: categorycode,
                    theid:theid
                },
                success: function (text) {
                    //alert(text);
            
                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addexpcategory.php",
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
                            url: "ajaxscripts/tables/expcategories.php",
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
            url: "ajaxscripts/forms/addexpcategory.php",
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