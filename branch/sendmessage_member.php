<?php
include('../../config.php');
$memberid = $_POST['id_index'];
$branch = $_POST['branch'];

$app = $mysqli->query("select * from `member` where id = '$memberid'");
$result = $app->fetch_assoc();
?>

<script>
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>


<section class="page-content container-fluid">
    <div class="form-group row">
        <div class="col-md-5">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Send Message to <?php echo $result['surname'] . ' ' .$result['firstname'] . ' ' .$result['othername'] ?>
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="">
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title"
                                   placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="10"
                                   placeholder="Enter Message"></textarea>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="button" class="btn btn-primary" id="saveessagebtn">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
        <div class="col-md-7">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Branch Messages
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <div class="kt-portlet__body">
                   <div id="sendmessage_div"></div>
                </div>
                <!--end::Form-->
            </div>
        </div>
    </div>
</section>

<!-- SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END CONTENT WRAPPER -->
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->

<script>
    $.ajax({
        type:"post",
        url: "ajax/tables/birthdaymessage_table.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        data:{
            memberid:'<?php echo $memberid ?>',
            branch:'<?php echo $branch ?>'
        },
        success: function (text) {
            $('#sendmessage_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },
    });

    $("#saveessagebtn").click(function () {
        var title = $("#title").val();
        var message = $("#message").val();

        var error = '';
        if (title == "") {
            error += 'Please enter title \n';
            $("#title").focus();
        }
        if (message == "") {
            error += 'Please enter message \n';
            $("#message").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/savebdmessage.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    memberid: '<?php echo $memberid ?>',
                    branch: '<?php echo $branch ?>',
                    title:title,
                    message:message
                },
                success: function (text) {
                    //alert(text);
                    $.notify("Message sent", "success", {position: "top center"});
                    //$("#mem-table").DataTable().ajax.reload(null, false );
                    $.ajax({
                        url: "ajax/tables/birthdaymessage_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#sendmessage_div').html(text);
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
            $.notify(error, {position: "top center"});
        }
        return false;
    });
</script>