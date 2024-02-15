<?php include ('../../../../config.php');

$id = $_POST['select_member'];
$getmember = $mysqli->query("select * from `member` where id = '$id'");
$resmember = $getmember->fetch_assoc();
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body">

        <div class="invoice-summary">
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">Branch:</small>
                    <p><?php
                        $branchid = $resmember['branch'];
                        $getbranch = $mysqli->query("select * from branch where id = '$branchid'");
                        $resbranch = $getbranch->fetch_assoc();
                        echo $resbranch['name'];
                        ?>
                    </p>
                    <hr>
                    <small class="text-muted">Date of Birth:</small>
                    <p><?php echo date("jS M, Y", strtotime($resmember['birthdate'])) ?></p>
                    <hr>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Telephone:</small>
                    <p><?php echo $resmember['telephone'] ?></p>
                    <hr>
                    <small class="text-muted">Residence:</small>
                    <p><?php echo $resmember['residence'] ?></p>
                    <hr>
                </div>
            </div>
        </div>

</form>
<!--end::Form-->

