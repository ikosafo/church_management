<?php include ('../../config.php'); ?>

<form class="form form-horizontal">
      <div class="row">
        <div class="mb-1 col-md-4">
          <label class="form-label" for="firstdate">Select First Date</label>
          <input type="text" id="firstdate" class="form-control" placeholder="Select First Date" />
        </div>
        <div class="mb-1 col-md-4">
          <label class="form-label" for="seconddate">Select Second Date</label>
          <input type="text" id="seconddate" class="form-control" placeholder="Select Second Date" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label"></label> <br/>
            <button type="button" id="statbtn" class="btn btn-primary me-1">Submit</button>
        </div>
       
      </div>
      
    </form>
    
<script>

    $("#firstdate").flatpickr({
        maxDate: new Date,
        enableTime: true,
        dateFormat: "Y-m-d H:i:s"
    });

    $("#seconddate").flatpickr({
        maxDate: new Date,
        enableTime: true,
        dateFormat: "Y-m-d H:i:s"
    });

    // Add action on form submit
    $("#statbtn").click(function(){

    var firstdate = $("#firstdate").val();
    var seconddate = $("#seconddate").val();

    var error = '';
    if (firstdate == "") {
        error += 'Please select start date \n';
        $("#firstdate").focus();
    }
    if (seconddate == "") {
        error += 'Please select end date \n';
        $("#seconddate").focus();
    }
    if (firstdate != "" && seconddate != "" && firstdate > seconddate) {
        error += 'End date should be less \n';
        $("#seconddate").focus();
    }
   
    if (error == "") {
        $.ajax({
            type: "POST",
            url: "ajaxscripts/queries/search/sales.php",
            beforeSend: function () {
                    $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
            },
            data: {
                firstdate:firstdate,
                seconddate:seconddate
            },
            success: function (text) {
                //alert(text);
                $('#searchform_div').html(text);
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
        $.notify(error, {position: "top right"});
    }
    return false;

});

</script>