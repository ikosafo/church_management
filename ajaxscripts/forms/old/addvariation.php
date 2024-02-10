<p class="card-text font-small mb-2">
    Add variation
</p>
<hr/>
<form class="form form-horizontal">
            <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="attributename">Attribute Name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="attributename" class="form-control" 
                        placeholder="Attribute Name" />
                </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="attributecode">Attribute Code</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="attributecode" class="form-control" 
                        placeholder="Attribute Code" />
                </div>
                </div>
            </div>
            
            <div class="col-sm-9 offset-sm-3">
                <button type="button" id="variationbtn" class="btn btn-primary me-1">Submit</button>
            </div>
            </div>
 </form>



<script>
     // Add action on form submit
     $("#variationbtn").click(function(){
    
      var attributename = $("#attributename").val();
      var attributecode = $("#attributecode").val();

      var error = '';
      if (attributename == "") {
          error += 'Please enter attribute name \n';
          $("#attributename").focus();
      }
      if (attributecode == "") {
          error += 'Please enter attribute code \n';
          $("#attributecode").focus();
      }
      
      if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/variations.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    attributename: attributename,
                    attributecode: attributecode
                },
                success: function (text) {
                    //alert(text);
            
                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addvariation.php",
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
                            url: "ajaxscripts/tables/variations.php",
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