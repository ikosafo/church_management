<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
$branch = $_SESSION['branch'];
?>

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

<!--begin::Form-->
<span>
    Not a member?, Add details here<br/> New Attendant not in list
</span>
<hr/>

<?php
$today = date('Y-m-d H:i:s');
$chkattendance = $mysqli->query("select * from service_config where branch = '$branch' and
                                   datefrom <= '$today' AND dateto >= '$today'");
$getcount = mysqli_num_rows($chkattendance);
$resattendance = $chkattendance->fetch_assoc();
$configid = $resattendance['configid'];

if ($getcount == '1') { ?>
    <form class="" autocomplete="off">

        <div class="kt-portlet__body" id="error_loc">
            <div id="success_loc"></div>

            <div class="form-group row">
                <div class="col-lg-12 col-md-12">
                    <label for="cell_name">Visitor Name</label>
                    <input type="text" class="form-control" id="visitor_name"
                           placeholder="Enter Visitor's Name">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12 col-md-12">
                    <label for="cell_name">Telephone</label>
                    <input type="text" class="form-control" id="telephone"
                           placeholder="Enter Telephone" onkeypress="return isNumber(event)">
                </div>
            </div>

            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="button" class="btn btn-primary" id="savevisitor">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>

    </form>
    <!--end::Form-->

<?php } ?>



<script>

    $('#savevisitor').click(function () {
        var visitor_name = $('#visitor_name').val();
        var telephone = $('#telephone').val();

        var error = '';
        if (visitor_name == "") {
            error += "Please enter visitor's name \n";
            $("#visitor_name").focus();
        }
        if (telephone == "") {
            error += "Please enter visitor's telephone \n";
            $("#telephone").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_visitoratt.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    visitor_name: visitor_name,
                    telephone: telephone
                },
                success: function (text) {
                    //alert(text);

                    $.ajax({
                        url: "ajax/forms/attendancevis_form.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#attendancevisform_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            KTApp.unblockPage();
                        },

                    });

                    $.ajax({
                        url: "ajax/tables/attendancevis_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#attendancevistable_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            KTApp.unblockPage();
                        },

                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });

        }
        else {
            $("#error_loc").notify(error, {position: "top center"});
        }
        return false;
    });


</script>