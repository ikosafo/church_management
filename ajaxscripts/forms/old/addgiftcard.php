<?php
include ('../../config.php');
?>

<form class="form form-horizontal">
            <div class="row">
                <div class="col-12">
                    <div class="mb-1 row">
                        <div class="col-sm-3">
                            <label class="col-form-label" for="giftcardnumber">Gift card Number</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="giftcardnumber" autocomplete="off" class="form-control" 
                                placeholder="Gift card Number" />
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1 row">
                        <div class="col-sm-3">
                            <label class="col-form-label" for="giftcardvalue">Value</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="giftcardvalue" autocomplete="off" class="form-control" 
                                placeholder="Gift card Value" />
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1 row">
                        <div class="col-sm-3">
                            <label class="col-form-label" for="description">Description</label>
                        </div>
                        <div class="col-sm-9">
                            <textarea id="description" class="form-control" 
                                placeholder="Description" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1 row">
                        <div class="col-sm-3">
                            <label class="col-form-label" for="customername">Customer Name</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-select" id="customername">
                                <option></option>
                                <?php
                                $getcustomer = $mysqli->query("select * from customer where status IS NULL");
                                while ($rescustomer = $getcustomer->fetch_assoc()) { ?>
                                    <option value="<?php echo $rescustomer['cusid'] ?>"><?php echo $rescustomer['fullname']; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            
            
                <div class="col-sm-9 offset-sm-3">
                    <button type="button" id="giftcardbtn" class="btn btn-primary me-1">Submit</button>
                </div>
            </div>
 </form>



<script>

    $("#customername").select2({
        placeholder: "Select Customer",
        allowClear: true
    });

     // Add action on form submit
     $("#giftcardbtn").click(function(){
    
      var giftcardnumber = $("#giftcardnumber").val();
      var giftcardvalue = $("#giftcardvalue").val();
      var description = $("#description").val();
      var customername = $("#customername").val();

      var error = '';
      if (giftcardnumber == "") {
          error += 'Please enter giftcard number \n';
          $("#giftcardnumber").focus();
      }
      if (giftcardvalue == "") {
          error += 'Please enter giftcard value \n';
          $("#giftcardvalue").focus();
      }
      if (giftcardvalue != "" && !$.isNumeric(giftcardvalue)) {
           error += 'Please enter only digits \n';
          $("#giftcardvalue").focus();
      }
      if (description == "") {
          error += 'Please enter description \n';
          $("#description").focus();
      }
      if (customername == "") {
          error += 'Please select name of customer \n';
          $("#customername").focus();
      }
      
      if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/giftcard.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    giftcardnumber: giftcardnumber,
                    giftcardvalue: giftcardvalue,
                    description:description,
                    customername:customername
                },
                success: function (text) {
                    //alert(text);
            
                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addgiftcard.php",
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
                            url: "ajaxscripts/tables/giftcards.php",
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