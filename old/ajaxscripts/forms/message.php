<p class="card-text font-small mb-2">
    Add message
</p>
<hr/>
<form class="form form-horizontal">
            <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="receipient">Receipient</label>
                </div>
                <div class="col-sm-9">
                <select class="form-select" id="receipient">
                        <option></option>
                        <option value="Developer">Developer</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Everyone">Everyone</option>
                    </select>
                </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="message">Message</label>
                </div>
                <div class="col-sm-9">
                    <textarea id="message" class="form-control" 
                        placeholder="Message" rows="6"></textarea>
                </div>
                </div>
            </div>
          
            <div class="col-sm-9 offset-sm-3">
                <button type="button" id="messagebtn" class="btn btn-primary me-1">Submit</button>
            </div>
            </div>
 </form>



<script>
    //Jquery plugins
    $("#receipient").select2({
        placeholder: "Select receipient",
        allowClear: true
    });

     // Add action on form submit
     $("#messagebtn").click(function(){
        
      var receipient = $("#receipient").val();
      var message = $("#message").val();

      var error = '';
      if (receipient == "") {
          error += 'Please select receipient \n';
      }
      if (message == "") {
          error += 'Please enter message or comment \n';
          $("#message").focus();
      }
     
      
      if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/message.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    receipient: receipient,
                    message: message
                },
                success: function (text) {
                    //alert(text);
                    $.ajax({
                            url: "ajaxscripts/forms/message.php",
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
                            url: "ajaxscripts/tables/messages.php",
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