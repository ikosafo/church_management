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


function getfinoffering($memberid) {
    return '<button class="btn btn btn-label-facebook payoffering_btn"
                    i_index='.$memberid.'>
                        Pay Offering
    </button>';
}


function getfintithe($memberid) {
    return '<button class="btn btn btn-label-facebook paytithe_btn"
                    i_index='.$memberid.'>
                        Pay Tithe
    </button>';
}


function getfinwelfare($memberid) {
    return '<button class="btn btn btn-label-facebook paywelfare_btn"
                    i_index='.$memberid.'>
                        Pay Welfare
            </button>';
}

function getfinff($memberid) {
    return '<button class="btn btn btn-label-facebook payff_btn"
                    i_index='.$memberid.'>
                        Pay First Fruit
    </button>';
}


function getfincontributions($memberid) {
    return '<button class="btn btn btn-label-facebook paycontributions_btn"
                    i_index='.$memberid.'>
                        Pay Contributions
    </button>';
}

function getfinmpartner($memberid) {
    return '<button class="btn btn btn-label-facebook paympartner_btn"
                    i_index='.$memberid.'>
                        Pay Partnership Dues
    </button>';
}
