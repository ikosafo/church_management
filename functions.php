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



//Get Branch Details
function getBranch($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="editbranchbtn" title="Edit branch"
                            i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deletebranchbtn" title="Delete Branch"
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



//Get Member Details
function getMemberDetails($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="viewmemberbtn" title="View Member Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle></svg>
                </span>
            </a>
            <a class="editmemberbtn" title="Edit Member Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </span>
            </a>
            <a class="deletememberbtn" title="Delete Member Details" i_index=' . $id . '>
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


//Get Member Details for Admin
function getMemberDetailsAdmin($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
            <a class="viewmemberbtn" title="View Member Details" i_index=' . $id . '>
                <span class="icon-wrapper cursor-pointer"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                    stroke-linejoin="round" class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle></svg>
                </span>
            </a>
           
        </div>';
}


//Get Convert Details
function getConvertDetails($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
           
            <a class="deleteconvertbtn" title="Delete Convert Details" i_index=' . $id . '>
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


//Get Visitor Details
function getVisitorDetails($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
           
            <a class="deletevisitorbtn" title="Delete Visitor Details" i_index=' . $id . '>
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


//Get Worker Details
function getBranchWorkerDetails($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
           
            <a class="deleteworkerbtn" title="Delete Worker Details" i_index=' . $id . '>
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


function getfinoffering($id)
{
    return '<button class="btn btn-primary payoffering_btn"
                    i_index=' . $id . '>
                        Pay Offering
    </button>';
}


function getfintithe($id)
{
    return '<button class="btn btn-primary paytithe_btn"
                    i_index=' . $id . '>
                        Pay Tithe
    </button>';
}


function getfinwelfare($id)
{
    return '<button class="btn btn-primary paywelfare_btn"
                    i_index=' . $id . '>
                        Pay Welfare
    </button>';
}

function getfinff($id)
{
    return '<button class="btn btn-primary payfirstfruit_btn"
                    i_index=' . $id . '>
                        Pay First Fruit
    </button>';
}


function getfincontributions($id)
{
    return '<button class="btn btn-primary paycontributions_btn"
                    i_index=' . $id . '>
                        Pay Contributions
    </button>';
}

function getfinmpartner($id)
{
    return '<button class="btn btn-primary paypartners_btn"
                    i_index=' . $id . '>
                        Pay Dues
    </button>';
}



//Get Meeting Config
function getMeetingConfig($id)
{
    //global $mysqli;
    return '
        <div class="text-center">
           
            <a class="deletemeetingbtn" title="Delete Meeting Details" i_index=' . $id . '>
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



function getFullName($id)
{
    global $mysqli;
    $getname = $mysqli->query("select * from members where id = '$id'");
    $resname = $getname->fetch_assoc();
    return $resname['fullname'];
}


function getTelephone($id)
{
    global $mysqli;
    $gettel = $mysqli->query("select * from members where id = '$id'");
    $restel = $gettel->fetch_assoc();
    return $restel['telephone'];
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
