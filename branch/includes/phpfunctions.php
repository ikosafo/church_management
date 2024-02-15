<?php

function lock($item){
    return base64_encode(base64_encode(base64_encode($item)));
}
function unlock($item){
    return base64_decode(base64_decode(base64_decode($item)));
}


// Date Period
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}



//Email verification
function email_verified($email_verified) {
    if ($email_verified == '1') {
        return "<span style = 'color:green'>Verified</span>";
    }
    else {
        return "<span style = 'color:red'>Not Verified</span>";
    }
}



//Email verification period
function email_verified_period($email_verified_period) {
    if ($email_verified_period == '') {
        return "N/A";
    }
    else {
        return time_elapsed_string($email_verified_period);
    }
}



//Get Applicant details
function getdetails($applicant_id) {
    include ('db.php');

    $q = mysqli_query($con,"select * from provisional where applicant_id = '$applicant_id'");
    $result = mysqli_fetch_assoc($q);

    $title = $result['title'];

    if ($title == "Other") {
        $title = $result['othertitle'];
        return $result["surname"] . " " . $result["first_name"] . " " . $result["other_name"]."(".$title.")";
    } else {
        return $result["surname"] . " " . $result["first_name"] . " " . $result["other_name"]."(".$title.")";
    }

}




//Get Exam Details

function examdetails($exam_id)
{
    include('db.php');

    $q = mysqli_query($con, "select * from examination_reg where examination_id = '$exam_id'");
    $result = mysqli_fetch_assoc($q);
    $internship_period = $result['internship_period'];
    $facility = $result['facility'];
    $previous_exam = $result['previous_exam'];
    $exam_attempts = $result['exam_attempts'];
    $exam_center = $result['exam_center'];
    return '<span class="kt-widget31__info">Internship Period: </span>
          <span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$internship_period.'</span><br/>
   <span class="kt-widget31__info">Facility: </span>
          <span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$facility.'</span><br/>
   <span class="kt-widget31__info">Previous Exam: </span>
          <span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$previous_exam.'</span><br/>
    <span class="kt-widget31__info">Exam Attempts: </span>
          <span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$exam_attempts.'</span><br/>
    <span class="kt-widget31__info">Exam Center: </span>
          <span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$exam_center.'</span><br/>';


}



//Get Applicant details
function getfulldetails($provisionalid)
{
    include('db.php');
    $reg_root = 'https://registration.ahpcgh.org';

    $q = mysqli_query($con, "select * from provisional where provisionalid = '$provisionalid'");
    $result = mysqli_fetch_assoc($q);
    $applicant_id = $result['applicant_id'];
    $img = mysqli_query($con, "select * from applicant_images where applicant_id = '$applicant_id'");
    $resultimg = mysqli_fetch_assoc($img);
    $imgloc = $reg_root . '/' . $resultimg['image_location'];
    $profession = $result['profession'];

    $title = $result['title'];
    if ($title == "Other") {
        $title = $result['othertitle'];
        $fullname = $result["surname"] . " " . $result["first_name"] . " " . $result["other_name"] . "(" . $title . ")";
    } else {
        $fullname = $result["surname"] . " " . $result["first_name"] . " " . $result["other_name"] . "(" . $title . ")";
    }

    return '<div class="kt-widget31">
                     <div class="kt-widget31__item">
						<div class="kt-widget31__content" style="width: 100% !important;">
							<div class="kt-widget31__pic kt-widget4__pic--pic">
								<!--<img src="'.$imgloc.'" alt="Img"> -->
							</div>
							<div class="kt-widget31__info" style="padding: 0 0.8rem;width:100% !important">
								<a href="#" class="kt-widget31__username" style="font-weight:300;font-size:1.0rem">
									'.$fullname.'
								</a>
								<p class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">
									'.$profession.'
								</p>
							</div>
						</div>
                      </div>
					</div>';
}




//Examination Status Buttons
function getexamremark($remarks) {

        if (strtolower($remarks) == "pass") {
            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Passed</span>';
        }
        else if (strtolower($remarks) == "fail") {
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Failed</span>';
        }
}




//CPD Period Regsitered

function cpdperiod($applicant_id,$year) {
    include ('db.php');

    $q = mysqli_query($con,"select r.period_registered
                           from renewal r
                          JOIN provisional p ON r.applicant_id = p.applicant_id
                         WHERE (r.cpdyear != '' AND r.cpdyear = '$year' AND r.applicant_id = '$applicant_id')");

    $result = mysqli_fetch_assoc($q);
    $period_registered =  $result['period_registered'];

    return $period_registered.'<br/>'.time_elapsed_string($period_registered);

}




//Approval State Buttons (CPD MIS)

function cpdshowbtnuser($applicant_id,$year) {
    include ('db.php');

        $q = mysqli_query($con,"select r.payment,r.cpd_usercheck_status,r.cpd_admincheck_status,r.period_registered,p.*
                           from renewal r
                          JOIN provisional p ON r.applicant_id = p.applicant_id
                         WHERE (r.cpdyear != '' AND r.cpdyear = '$year' AND r.applicant_id = '$applicant_id')");

    $result = mysqli_fetch_assoc($q);
    $cpd_usercheck_status =  $result['cpd_usercheck_status'];
    $payment =  $result['payment'];

    if ($payment == "1") {
        if ($cpd_usercheck_status == "Approved"){
            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>';
        }
        else if ($cpd_usercheck_status == "Rejected") {
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Rejected</span>';
        }
        else {
            return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">Pending ...</span>';
        }
    }
    else {
        return '<span style="color: red">Not Paid</span>';
    }

}




//Approval State Buttons (CPD ADMIN)

function cpdshowbtnadmin($applicant_id,$year) {
    include ('db.php');

    $q = mysqli_query($con,"select r.payment,r.cpd_usercheck_status,r.cpd_admincheck_status,r.period_registered,p.*
                           from renewal r
                          JOIN provisional p ON r.applicant_id = p.applicant_id
                         WHERE (r.cpdyear != '' AND r.cpdyear = '$year' AND r.applicant_id = '$applicant_id')");

    $result = mysqli_fetch_assoc($q);
    $cpd_usercheck_status =  $result['cpd_usercheck_status'];
    $cpd_admincheck_status =  $result['cpd_admincheck_status'];


    if ($cpd_usercheck_status == "Approved" && $cpd_admincheck_status == ""){
        return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">Pending ...</span>';
    }
    else if ($cpd_admincheck_status == "Rejected") {
        return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Rejected</span>';
    }
    else if ($cpd_admincheck_status == "Approved"){

        return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>';
    }

}





//Approval State Buttons (Permanent MIS Admin)
function pershowbtnuser($applicant_id) {
    include ('db.php');

    $q = mysqli_query($con,"select * from provisional where applicant_id = '$applicant_id'");
    $result = mysqli_fetch_assoc($q);
    $permanent_usercheck_status =  $result['permanent_usercheck_status'];
    $permanent_payment =  $result['permanent_payment'];

    if ($permanent_payment == "1") {
        if ($permanent_usercheck_status == "Approved"){
            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>';
        }
        else if ($permanent_usercheck_status == "Rejected") {
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Rejected</span>';
        }
        else {
            return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">Pending ...</span>';
        }
    }
    else {
        return '<span style="color: red">Not Paid</span>';
    }

}




//Approval State Buttons (Provisional MIS Admin)
function proshowbtnuser($applicant_id) {
    include ('db.php');

    $q = mysqli_query($con,"select * from provisional where applicant_id = '$applicant_id'");
    $result = mysqli_fetch_assoc($q);
    $provisional_usercheck_status =  $result['provisional_usercheck_status'];
    $provisional_payment =  $result['provisional_payment'];

    if ($provisional_payment == "1") {
        if ($provisional_usercheck_status == "Approved"){
            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>';
        }
        else if ($provisional_usercheck_status == "Rejected") {
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Rejected</span>';
        }
        else {
            return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">Pending ...</span>';
        }
    }
    else {
        return '<span style="color: red">Not Paid</span>';
    }

}




//Approval State Buttons (Exam Officer)
function exshowbtnuser($applicant_id) {
    include ('db.php');

    $q = mysqli_query($con,"select * from examination_reg where applicant_id = '$applicant_id'");
    $result = mysqli_fetch_assoc($q);
    $exam_usercheck_status =  $result['exam_usercheck_status'];
    $exam_payment =  $result['payment'];

    if ($exam_payment == "1") {
        if ($exam_usercheck_status == "Approved"){
            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>';
        }
        else if ($exam_usercheck_status == "Rejected") {
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Rejected</span>';
        }
        else {
            return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">Pending ...</span>';
        }
    }
    else {
        return '<span style="color: red">Not Paid</span>';
    }

}




//Pin Update Status
function pinupdatestatus($pin_updated) {

    if ($pin_updated == "1") {
        return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill"><i class="fa fa-check"></i> </span>';
    }
   else {
       return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill"><i class="fa fa-times"></i></span>';
    }
}



//Pin Update Status
function resendmailstatus($resend_mail) {

    if ($resend_mail == "1") {
        return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill"><i class="fa fa-check"></i> </span>';
    }
   else {
       return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill"><i class="fa fa-times"></i></span>';
    }
}




//Approval State Buttons (Permanent Super Admin)
function pershowbtnadmin($applicant_id) {
    include ('db.php');

    $q = mysqli_query($con,"select * from provisional where applicant_id = '$applicant_id'");
    $result = mysqli_fetch_assoc($q);
    $permanent_usercheck_status =  $result['permanent_usercheck_status'];
    $permanent_admincheck_status =  $result['permanent_admincheck_status'];


        if ($permanent_usercheck_status == "Approved" && $permanent_admincheck_status == ""){
            return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">Pending ...</span>';
        }
        else if ($permanent_admincheck_status == "Rejected") {
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Rejected</span>';
        }
        else if ($permanent_admincheck_status == "Approved"){

            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>';
        }

}




//Approval State Buttons (Provisional Super Admin)
function proshowbtnadmin($applicant_id) {
    include ('db.php');

    $q = mysqli_query($con,"select * from provisional where applicant_id = '$applicant_id'");
    $result = mysqli_fetch_assoc($q);
    $provisional_usercheck_status =  $result['provisional_usercheck_status'];
    $provisional_admincheck_status =  $result['provisional_admincheck_status'];


    if ($provisional_usercheck_status == "Approved" && $provisional_admincheck_status == ""){
        return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">Pending ...</span>';
    }
    else if ($provisional_admincheck_status == "Rejected") {
        return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Rejected</span>';
    }
    else if ($provisional_admincheck_status == "Approved"){

        return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>';
    }

}





//Approval State Buttons (Exam Super Admin)
function exshowbtnadmin($applicant_id) {
    include ('db.php');

    $q = mysqli_query($con,"select * from examination_reg where applicant_id = '$applicant_id'");
    $result = mysqli_fetch_assoc($q);
    $exam_usercheck_status =  $result['exam_usercheck_status'];
    $exam_admincheck_status =  $result['exam_admincheck_status'];


    if ($exam_usercheck_status == "Approved" && $exam_admincheck_status == ""){
        return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">Pending ...</span>';
    }
    else if ($exam_admincheck_status == "Rejected") {
        return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Rejected</span>';
    }
    else if ($exam_admincheck_status == "Approved"){

        return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>';
    }

}


//Exam Approval Btn
function examapproval($examination_id) {
    return '<button class="btn btn btn-label-facebook examapprove_btn"
                    i_index='.$examination_id.'>
                        View and Approve
    </button>';
}


//Pin Update Btn
function pin_update($applicant_id) {
    return '<button class="btn btn btn-label-facebook pinupdate_btn"
                    i_index='.$applicant_id.'>
                       Update Pin
    </button>';
}



//Pin Update Btn
function resend_email($applicant_id) {
    return '<button class="btn btn btn-label-facebook resendmail_btn"
                    i_index='.$applicant_id.'>
                      Resend Mail
    </button>';
}



//Exam Approval Btn
function itdel($applicant_id) {
    return '<button class="btn btn btn-label-facebook examapprove_btn"
                    i_index='.$applicant_id.'>
                       Delete
    </button>';
}



//CPD MIS Approval Btn
function cpdmisapproval($applicant_id,$year) {
    return '<button class="btn btn btn-label-facebook cpdmisapprove_btn"
                    i_index='.$applicant_id.' i_year ='.$year.'>
                        View and Approve
    </button>';
}




//CPD Super Admin Approval Btn
function cpdsuperapproval($applicant_id,$year) {
    return '<button class="btn btn btn-label-facebook cpdsuperapprove_btn"
                    i_index='.$applicant_id.' i_year ='.$year.'>
                        View and Approve
    </button>';
}



//MIS Approval Btn
function misapproval($applicant_id) {
    return '<button class="btn btn btn-label-facebook misapprove_btn"
                    i_index='.$applicant_id.'>
                        View and Approve
    </button>';
}


//Super Approval Btn
function superapproval($applicant_id) {
    return '<button class="btn btn btn-label-facebook superapprove_btn"
                    i_index='.$applicant_id.'>
                        View and Approve
    </button>';
}



// Reply Message
function replymessage($id) {
    return '<button class="btn btn-success btn-outline btn-sm reply_message"
                    i_index='.$id.'>
                        Click to reply
    </button>';
}


//Get Payment Status
function getpayment ($payment) {
    if ($payment == '1') {
        return '<span style="color:green">Paid</span>';
    }
    else {
        return '<span style="color: red">Not Paid</span>';
    }
}


//Get Payment Status
function getpmtstatus ($payment) {
    if ($payment == '1') {
        return '<span style="color:green">Paid</span>';
    }
    else {
        return '<span style="color: red">Not Paid</span>';
    }
}


//Get Payment Status
function getregstatus ($status) {
    if ($status == '1') {
        return '<span style="color:green">Registered</span>';
    }
    else {
        return '<span style="color: red">Not Registered</span>';
    }
}


//Provisional Link Details
function linkdetails ($applicant_id) {
    $newid = lock(lock($applicant_id));
    return  '<a href="provisional_details.php?app_id='.$newid.'" target="_blank">
    <button class="btn btn-success btn-outline btn-sm" style="font-size: small">
        View details
    </button>
</a>';
}


//Permanent Link Details
function perlinkdetails ($applicant_id) {
    $newid = lock(lock($applicant_id));
    return  '<a href="permanent_details.php?app_id='.$newid.'" target="_blank">
    <button class="btn btn-success btn-outline btn-sm" style="font-size: small">
        View details
    </button>
</a>';
}



//Provisional Link Details
function prolinkdetails ($applicant_id) {
    $newid = lock(lock($applicant_id));
    return  '<a href="provisional_details.php?app_id='.$newid.'" target="_blank">
    <button class="btn btn-success btn-outline btn-sm" style="font-size: small">
        View details
    </button>
</a>';
}



//Provisional Link Details
function provisionalapprovaldetails ($applicant_id) {
    return '<button class="btn btn-success btn-outline btn-sm approvalbtn"
                            applicantid = '.$applicant_id.'>
                       Approve
                    </button>';

}


//CPD Link Details
function cpdlinkdetails ($applicant_id,$year) {
    $newid = lock(lock($applicant_id));
    return  '<a href="renewal_details.php?app_id='.$newid.'&year='.$year.'" target="_blank">
    <button class="btn btn-success btn-outline btn-sm" style="font-size: small">
        View details
    </button>
</a>';
}



//Delete Special Case
function deletelink($id) {
    return ' <button type="button"
                                data-type="confirm"
                                class="btn btn-danger js-sweetalert delete_applicant"
                                i_index='.$id.'
                                title="Delete">
                            <i class="flaticon2-trash ml-2" style="color:#fff !important;"></i>
                        </button>';
}


//Get Profession
function getprofession ($id) {
    include ('db.php');

    $q = mysqli_query($con,"select * from professions where professionid = '$id'");
    $result = mysqli_fetch_assoc($q);
    return $result['professionname'];
}



//Get MIS User
function getuser($userid) {
    include ('db.php');

    $q = mysqli_query($con,"select * from mis_users where user_id = '$userid'");
    $result = mysqli_fetch_assoc($q);
    return $result['full_name'];
}


//Get Pin Update Status
function getpinstatus($newpin) {
    include ('db.php');

    $q = mysqli_query($con,"select * from provisional where provisional_pin = '$newpin'");
    $result = mysqli_fetch_assoc($q);

    if (mysqli_num_rows($q) == '1') {
        return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Successful</span>';
    }
    else {
        return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Failed</span>';
    }
}


//Get Mail Status
function getmailstatus($pin) {
    include ('db.php');

    $q = mysqli_query($con,"select * from provisional where provisional_pin = '$pin' and resend_mail = '1'");
    $result = mysqli_fetch_assoc($q);

    if (mysqli_num_rows($q) == '1') {
        return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Successful</span>';
    }
    else {
        return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Failed</span>';
    }
}



function getmemberdetails($memberid){
    include ('db.php');
    $q = mysqli_query($con,"select * from `member_images` where memberid = '$memberid'");
    $resimage = mysqli_fetch_assoc($q);
    $theimage = $resimage['image_location'];

    $getdetails = mysqli_query($con,"select * from `member` where memberid = '$memberid'");
    $resdetails = mysqli_fetch_assoc($getdetails);
    $surname = $resdetails['surname'];
    $firstname = $resdetails['firstname'];
    $othername = $resdetails['othername'];
    $gender = $resdetails['gender'];
    $telephone = $resdetails['telephone'];

    if ($theimage == "") {
        return '<span style="width: 294px;">
                                <div class="kt-user-card-v2">
                                    <div class="kt-user-card-v2__pic">
                                    </div>
                                    <div class="kt-user-card-v2__details">
                                        <a class="kt-user-card-v2__name view_member"
                                           member_index="'.$memberid.'"
                                           href="#">'.$surname.' '.$firstname.' '.$othername.'
                                        </a>
                                        <span class="kt-user-card-v2__email">'.$gender.', '.$telephone.'</span></div>
                                </div>
                            </span>';
    }
    else {
        return '<span style="width: 294px;">
                                <div class="kt-user-card-v2">
                                    <div class="kt-user-card-v2__pic">
                                       <img style="width: 40px;height: 40px"
                                             src="../'.$theimage.'">
                                    </div>
                                    <div class="kt-user-card-v2__details">
                                        <a class="kt-user-card-v2__name view_member"
                                           member_index="'.$memberid.'"
                                           href="#">'.$surname.' '.$firstname.' '.$othername.'
                                        </a>
                                        <span class="kt-user-card-v2__email">'.$gender.', '.$telephone.'</span></div>
                                </div>
                            </span>';
    }


}


function getdepartment($department){
    include ('db.php');

    $q = mysqli_query($con,"select * from `department` where id = '$department'");
    $resdept = mysqli_fetch_assoc($q);
    $thedepartment = $resdept['department_name'];
    return $thedepartment;

}

/*Member Functions*/
function getbranch($id) {
    include ('db.php');
    $q = mysqli_query($con,"select * from branch where id = '$id'");
    $result = mysqli_fetch_assoc($q);
    return $result['name'];
}


function memberdetails($id) {
    return '<button class="btn btn btn-label-facebook memberdetailsbtn" memberid = '.$id.'>View Details</button>';
}

function convertdetails($id) {
    return '<button class="btn btn btn-label-facebook convertdetailsbtn" memberid = '.$id.'>View Details</button>';
}


