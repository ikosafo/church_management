<?php
include('../config.php');

$memberid = $_POST['id_index'];
$branch = $_POST['branch'];
$paymenttype = 'Partners';
//$user_id = $_SESSION['user_id'];

$app = $mysqli->query("select * from `members` where id = '$memberid'");
$result = $app->fetch_assoc();
?>

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 &&
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>

<div class="form-group row">
    <div class="col-md-5">
        <p class="card-text font-small mb-2">
            Payment of Partnership dues for <?php echo $result['fullname']; ?>
        </p>
        <hr />
        <form class="form form-horizontal" id="partnersform">
            <div class="row">
                <div class="mb-1 col-md-12">
                    <label for="purpose" class="form-label">Purpose</label>
                    <textarea class="form-control" id="purpose" rows="3" placeholder="Enter Purpose"></textarea>
                </div>
                <div class="mb-1 col-md-12">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="amount" placeholder="Enter amount" onkeypress="return isNumberKey(event)">
                </div>
                <div class="mb-1 col-md-12">
                    <label for="datepaid" class="form-label">Date Paid</label>
                    <input type="text" class="form-control" id="datepaid" placeholder="Select Date Paid" value="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>

            <div class="row">
                <div class="mb-1 col-md-12">
                    <button type="button" id="savepaymentbtn" class="btn btn-primary me-1">Submit</button>
                </div>

            </div>

        </form>

    </div>
    <div class="col-md-7">
        <p class="card-text font-small mb-2">
            Summary Data
        </p>
        <hr />
        <div id="paymenttable_div"></div>
    </div>
</div>




<!-- SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END CONTENT WRAPPER -->
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->

<script>
    $("#datepaid").flatpickr();

    $.ajax({
        type: "post",
        url: "ajaxscripts/tables/payments.php",
        beforeSend: function() {
            $.blockUI({
                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
            });
        },
        data: {
            memberid: '<?php echo $memberid ?>',
            paymenttype: '<?php echo $paymenttype ?>',
            branch: '<?php echo $branch ?>'
        },
        success: function(text) {
            $('#paymenttable_div').html(text);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function() {
            $.unblockUI();
        },
    });


    $("#savepaymentbtn").click(function() {
        var purpose = $("#purpose").val();
        var amount = $("#amount").val();
        var datepaid = $("#datepaid").val();

        var error = '';
        if (purpose == "") {
            error += 'Please enter purpose of contribution \n';
            $("#purpose").focus();
        }
        if (amount == "") {
            error += 'Please enter amount \n';
            $("#amount").focus();
        }
        if (datepaid == "") {
            error += 'Please select date paid \n';
            $("#datepaid").focus();
        }
        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/paypartners.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    memberid: '<?php echo $memberid ?>',
                    branch: '<?php echo $branch ?>',
                    amount: amount,
                    purpose: purpose,
                    datepaid: datepaid
                },
                success: function(text) {
                    //alert(text);
                    $.notify("Payment Made", "success", {
                        position: "top center"
                    });

                    $("#table-data").DataTable().ajax.reload(null, false);
                    document.getElementById("partnersform").reset();

                    $.ajax({
                        type: "post",
                        url: "ajaxscripts/tables/payments.php",
                        beforeSend: function() {
                            $.blockUI({
                                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                            });
                        },
                        data: {
                            memberid: '<?php echo $memberid ?>',
                            paymenttype: '<?php echo $paymenttype ?>',
                            branch: '<?php echo $branch ?>'
                        },
                        success: function(text) {
                            $('#paymenttable_div').html(text);
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
            $.notify(error, {
                position: "top center"
            });
        }
        return false;
    });
</script>