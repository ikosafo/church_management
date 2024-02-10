<?php
//include_once ('config.php');

function lock($item)
{
    return base64_encode(base64_encode(base64_encode($item)));
}
function unlock($item)
{
    return base64_decode(base64_decode(base64_decode($item)));
}


// call this fucntion to generate the bill for renewal applicants

function renewalBill($applicantid)
{
    global $mysqli;

    // get pin
    $getpin = "SELECT provisional_pin from provisional where applicant_id ='$applicantid'";
    $p = $mysqli->query($getpin)->fetch_assoc();
    $pin =  $p['provisional_pin'];

    $getamt = "SELECT sum(amount) as amt from owing where pin ='$pin' and payment=0 ";
    $a = $mysqli->query($getamt)->fetch_assoc();
    $amt =  $a['amt'];

    // get renewal data
    $getuser = "SELECT * from renewal where applicant_id ='$applicantid'";
    $data = $mysqli->query($getuser);

    //get academic level
    $getuser = "SELECT acad_level from provisional where applicant_id = '$applicantid'";
    $l = $mysqli->query($getuser)->fetch_assoc();
    $level =  $l['acad_level'];
    $bills = [];
    while ($d = $data->fetch_assoc()) :
        if ($d['payment'] == 0) {
            $bill = renewalamount($level, 'Permanent Renewal', $d['cpdyear']);
            array_push($bills, $bill);
        }
    endwhile;
    $billz = array_sum($bills);
    return $billz + $amt;
}


ob_start();
system('ipconfig /all');
$mycom = ob_get_contents();
ob_clean();
$findme = 'physique';
$pmac = strpos($mycom, $findme);
$mac_address = substr($mycom, ($pmac + 33), 17);

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}
$ip_add = getRealIpAddr();



// Date Period
function time_elapsed_string($datetime, $full = false)
{
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


function getExpiryDate($expirydate)
{
    $today = date("Y-m-d");
    if ($expirydate == "0000-00-00") {
        return '';
    } else if ($today > $expirydate) {
        return '<div class="d-flex flex-column text-center">
        <span class="badge badge-light-danger fw-bolder mb-25">Expired</span>
        <span class="font-small-2 text-muted">' . $expirydate . '</span>
    </div>';


        return $expirydate . '<br/><span class="badge badge-light-danger me-1">Item has expired</span>';
    } else {
        // Calculating the difference in timestamps
        $diff = strtotime($expirydate) - strtotime($today);

        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds

        $timdiff = abs(round($diff / 86400));
        if ($timdiff == '0') {
            return '<div class="d-flex flex-column text-center">
            <span class="badge badge-light-secondary fw-bolder mb-25">Expires today</span>
            <span class="font-small-2 text-muted">' . $expirydate . '</span>
        </div>';
        } else if ($timdiff == '1') {
            return '<div class="d-flex flex-column text-center">
            <span class="badge badge-light-danger fw-bolder mb-25">' . $timdiff . ' day more' . '</span>
            <span class="font-small-2 text-muted">' . $expirydate . '</span>
        </div>';
        } else {
            if ($timdiff > 30 && $timdiff < 40) {
                $colorbadge = "badge-light-warning";
            } else if ($timdiff < 31) {
                $colorbadge = "badge-light-danger";
            } else {
                $colorbadge = "badge-light-success";
            }

            return '<div class="d-flex flex-column text-center">
            <span class="badge ' . $colorbadge . ' fw-bolder mb-25">In ' . $timdiff . ' days</span>
            <span class="font-small-2 text-muted">' . $expirydate . '</span>
        </div>';
        }
    }
}



//Get Category Details
function getCategory($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="editcategorybtn" title="Edit Category"
                            i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deletecategorybtn" title="Delete Category"
                            i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer" title="Delete Category"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
        </div>';
}



//Get Category Details
function getSubcategory($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="editsubcategorybtn" title="Edit Subategory" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deletesubcategorybtn" title="Delete Subcategory" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer" title="Delete Subcategory"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
         </div>';
}



//Get Variation Details
function getVariation($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="editvariationbtn" title="Edit Attribute" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deletevariationbtn" title="Delete Attribute" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
     
        </div>';
}



//Get User Details
function getUser($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="edituserbtn" title="Edit User Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deleteuserbtn" title="Delete User Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
     
        </div>';
}



//Get Expense Category Details
function getExpCategory($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="editexpcategorybtn" title="Edit Category"
                            i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deleteexpcategorybtn" title="Delete Category"
                            i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer" title="Delete Category"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
               
            
            </div>';
}



//Get Customer Details
function getCustomer($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="viewcustomerbtn" title="View Customer Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle></svg>
                </span>
            </a>
            <a class="editcustomerbtn" title="Edit User Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deletecustomerbtn" title="Delete User Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
     
        </div>';
}



//Get Supplier Details
function getSupplier($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="viewsupplierbtn" title="View Supplier Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle></svg>
                </span>
            </a>
            <a class="editsupplierbtn" title="Edit User Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deletesupplierbtn" title="Delete User Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
     
        </div>';
}




//Get Sales Details
function getSales($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="viewsalebtn" title="View Sale Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle></svg>
                </span>
            </a>
            <a class="printsalebtn" title="Print Sale" i_index=' . $id . '>
            <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect></svg>
            </span>
        </a>
           
     
        </div>';
}

function getTempSales($prodid)
{
    global $mysqli;
    $getqty = $mysqli->query("select * from products where prodid = '$prodid'");
    $resqty = $getqty->fetch_assoc();
    $quantity = $resqty['quantity'];
    if ($quantity < 1) {
        return "No item left";
    } else {
        return '<button class="btn btn-primary btn-sm btn-icon gettempsales" style="padding:0.4rem"
     i_index=' . $prodid . '>
                <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" 
                stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" 
                class="css-i6dzq1"><polyline points="9 18 15 12 9 6"></polyline></svg>
     </button>';
    }
}


//Get Product Details
function getProductDetails($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="viewproductbtn" title="View Product Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle></svg>
                </span>
            </a>
            <a class="editproductbtn" title="Edit Product Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deleteproductbtn" title="Delete Product Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
     
        </div>';
}



//Get Expense Details
function getExpense($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="viewexpensebtn" title="View Expense Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle></svg>
                </span>
            </a>
            <a class="deleteexpensebtn" title="Delete Expense Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
     
        </div>';
}



//Get Giftcard Details
function getGiftcard($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="viewgiftcardbtn" title="View Gift Card Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle></svg>
                </span>
            </a>

            <a class="deletegiftcardbtn" title="Delete Gift Card Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </span>
            </a>
     
        </div>';
}


function getProdName($id)
{
    global $mysqli;
    $getname = $mysqli->query("select * from products where prodid = '$id'");
    $resname = $getname->fetch_assoc();
    $productname = $resname['productname'];
    $salestatus = $resname['salestatus'];
    /* $category = getcategoryname($resname['category']);
    $subcategory = subcategoryName($resname['subcategory']); */

    return '<div>
        <div class="fw-bolder">' . $productname . '</div>
        <div class="font-small-2 text-muted">' . $salestatus . '</div>
    </div>';

    /* return '<div>
                <div class="fw-bolder">' . $productname . '</div>
                <div class="font-small-2 text-muted">' . $category . ' - ' . $subcategory . '</div>
            </div>'; */

    //return $productname.'<br/> <small>'.$category.' -  '.$subcategory.'</small>';
}



function getQuantity($id)
{
    global $mysqli;

    $getname = $mysqli->query("select * from products where prodid = '$id'");
    $resname = $getname->fetch_assoc();
    $quantitysale = $resname['quantity'];
    $stockthreshold = $resname['stockthreshold'];

    if ($stockthreshold == $quantitysale) {
        $colorbadge = "badge-light-warning";
    } else if ($stockthreshold > $quantitysale) {
        $colorbadge = "badge-light-danger";
    } else {
        $colorbadge = "badge-light-success";
    }

    return '<div class="d-flex flex-column text-center">
                <span class="badge ' . $colorbadge . ' fw-bolder mb-25">' . $quantitysale . '</span>
             </div>';
}



function getQuantityNewArrival($id)
{
    global $mysqli;

    $getname = $mysqli->query("select * from newarrivals where newarrid = '$id'");
    $resname = $getname->fetch_assoc();
    $quantitysale = $resname['quantity'];

    return '<div class="d-flex flex-column text-center">
                <span class="badge badge-light-primary fw-bolder mb-25">' . $quantitysale . '</span>
             </div>';
}



//Get category name
function getcategoryname($id)
{
    global $mysqli;

    $getname = $mysqli->query("select * from categories where catid = '$id'");
    $resname = $getname->fetch_assoc();
    //return $resname['categoryname'];
    return '<span class="badge badge-light-primary">' . $resname["categoryname"] . '</span>';
}

//Get product expiry date
function getExpiryDateold($id)
{
    global $mysqli;

    $getdate = $mysqli->query("select * from products where prodid = '$id'");
    $resdate = $getdate->fetch_assoc();
    $expirydate = $resdate['expirydate'];
    if ($expirydate == "0000-00-00") {
        return "";
    } else {
        return $expirydate . '<span class="badge badge-light-primary me-1">' . time_elapsed_string($expirydate) . '</span>';
    }

    //return '<span class="badge badge-light-primary me-1">'.$resname["categoryname"].'</span>';

}

function getCurrentQuantity($id)
{
    global $mysqli;

    $getname = $mysqli->query("select * from products where prodid = '$id'");
    $resname = $getname->fetch_assoc();
    echo $quantitysale = $resname['quantitysale'];
}


/********* ALL SITE GENERAL FUNCTIONS  **********/

function categoryName($id)
{
    global $mysqli;
    $getname = $mysqli->query("select * from categories where catid = '$id'");
    $resname = $getname->fetch_assoc();
    return $resname["categoryname"];
}

function supplierName($id)
{
    global $mysqli;
    $getname = $mysqli->query("select * from supplier where supid = '$id'");
    $resname = $getname->fetch_assoc();
    if ($id == "0" || $id == "" || $id == "Others") {
        return 'Others';
    } else {
        return $resname['fullname'] . ' - ' . $resname['companyname'];
    }
}

function subcategoryName($id)
{
    global $mysqli;
    $getname = $mysqli->query("select * from subcategories where subcatid = '$id'");
    $resname = $getname->fetch_assoc();
    return $resname["subcategoryname"];
}

function variationName($id)
{
    global $mysqli;
    $getname = $mysqli->query("select * from variations where varid = '$id'");
    $resname = $getname->fetch_assoc();
    return $resname["attributename"];
}

function getCustomerName($id)
{
    global $mysqli;
    $getname = $mysqli->query("select * from customer where cusid = '$id'");
    $resname = $getname->fetch_assoc();
    return $resname["fullname"];
}

function getSupplierName($id)
{
    global $mysqli;
    $getname = $mysqli->query("SELECT * FROM supplier WHERE supid = '$id'");

    // Check if the query was successful and if it returned any rows
    if ($getname && $getname->num_rows > 0) {
        $resname = $getname->fetch_assoc();
        return $resname["fullname"];
    } else {
        // Handle the case where no results were found
        return "Supplier Not Found";
    }
}


function getStaffName($id)
{
    global $mysqli;
    $getname = $mysqli->query("select * from staff where stid = '$id'");
    $resname = $getname->fetch_assoc();
    return $resname["fullname"];
}

function getProductName($id)
{
    global $mysqli;
    $getname = $mysqli->query("SELECT * FROM products WHERE prodid = '$id'");

    // Check if the query was successful and if it returned any rows
    if ($getname && $getname->num_rows > 0) {
        $resname = $getname->fetch_assoc();
        return $resname["productname"];
    } else {
        // Handle the case where no results were found
        return "Product Not Found";
    }
}


//Get expense category name
function getexpcategoryname($id)
{
    global $mysqli;
    $getname = $mysqli->query("select * from expcategories where expcatid = '$id'");
    $resname = $getname->fetch_assoc();
    return $resname["categoryname"];
}

//Get log name
function getLogname($user)
{
    global $mysqli;

    $getname = $mysqli->query("SELECT * FROM staff WHERE username = '$user'");

    // Check if the query was successful and if it returned any rows
    if ($getname && $getname->num_rows > 0) {
        $resname = $getname->fetch_assoc();
        return $resname['fullname'];
    } else {
        // Handle the case where no results were found
        return "";
    }
}
