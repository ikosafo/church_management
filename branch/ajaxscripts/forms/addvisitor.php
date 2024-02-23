<style>
    body {
        overflow-x: hidden !important;
    }
</style>
<p class="card-text font-small mb-2">
    Add New Visitor
</p>
<hr />
<form class="form form-horizontal" autocomplete="off">
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="fullname">Full Name</label>
            <input type="text" id="fullname" class="form-control" placeholder="Full Name" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="telephone">Telephone</label>
            <input type="number" id="telephone" class="form-control" placeholder="Telephone" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="residence">Residence</label>
            <input type="text" id="residence" class="form-control" placeholder="Residence" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="curdenom">Current Denomination</label>
            <input type="text" id="curdenom" class="form-control" placeholder="Current Denomination" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="hearingabout">How did you hear about us? </label>
            <select id="hearingabout" style="width: 100%">
                <option value="">Select</option>
                <option value="A Friend">A Friend</option>
                <option value="Poster">Poster</option>
                <option value="Flier">Flier</option>
                <option value="TV">TV</option>
                <option value="Radio">Radio</option>
                <option value="Internet">Internet</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="invitationdesc">Description </label>
            <textarea id="invitationdesc" class="form-control" style="width: 100%" placeholder="Enter description"></textarea>
        </div>

    </div>

    <div class="row">

        <div class="mb-1 col-md-6">
            <button type="button" id="visitorbtn" class="btn btn-primary me-1">Submit</button>
        </div>

    </div>

</form>



<script>
    $("#hearingabout").select2({
        placeholder: "Select ",
        allowClear: true
    });

    // Add action on form submit
    $("#visitorbtn").click(function() {

        var fullname = $("#fullname").val();
        var telephone = $("#telephone").val();
        var residence = $("#residence").val();
        var curdenom = $("#curdenom").val();
        var hearingabout = $("#hearingabout").val();
        var invitationdesc = $("#invitationdesc").val();

        var error = '';
        if (fullname == "") {
            error += 'Please enter full name \n';
            $("#fullname").focus();
        }
        if (telephone == "") {
            error += 'Please enter telephone \n';
            $("#telephone").focus();
        }
        if (residence == "") {
            error += 'Please enter residence \n';
            $("#residence").focus();
        }
        if (curdenom == "") {
            error += 'Please enter current denomination \n';
            $("#curdenom").focus();
        }
        if (hearingabout == "") {
            error += 'Please specify how you heard from us \n';
            $("#hearingabout").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/visitor.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    fullname,
                    telephone,
                    residence,
                    curdenom,
                    hearingabout,
                    invitationdesc
                },
                success: function(text) {
                    //alert(text);

                    $('html, body').animate({
                        scrollTop: $("#pagetable_div").offset().top
                    }, 100);

                    $.ajax({
                        url: "ajaxscripts/forms/addvisitor.php",
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

                    $.ajax({
                        url: "ajaxscripts/tables/visitors.php",
                        beforeSend: function() {
                            $.blockUI({
                                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                            });
                        },
                        success: function(text) {
                            $('#pagetable_div').html(text);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function() {
                            $.unblockUI();
                        },

                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                    $.unblockUI();
                },
            });
        } else {
            $("#error_loc").notify(error, {
                position: "right"
            });
        }
        return false;

    });
</script>