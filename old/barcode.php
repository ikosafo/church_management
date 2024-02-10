
<?php                                                                          
   error_reporting(0);
   date_default_timezone_set("Asia/Singapore"); //set the time zone  
$con = mysql_connect('localhost:3308', 'root','root');

if (!$con) {
    echo 'failed';
    die();
}

mysql_select_db("pos", $con);
$sr_date =date('Y-m-d H:i:s');

$sql = "SELECT sr_number FROM receiving_materials ORDER BY sr_date DESC LIMIT 1";
        $result = mysql_query($sql, $con);
        
        if (!$result) {
            echo 'failed'; 
            die();
        }
        $total = mysql_num_rows($result);
        if ($total <= 0) {
            $currentSRNum = 1;
             $currentYear  = (int)(date('y'));
            $currentMonth = (int)(date('m'));
            $currentDay = (int)(date('d'));
           
            $currentSRYMD = substr($row['sr_number'], 0, 6);
            $currentYMD = date("ymd");
            if ($currentYMD > $currentSRYMD) 
            {  
                $currentSRNum = 1;
            } 
            else 
            {  
                $currentSRNum += 1;
            }     
             
        } 
        else {
//------------------------------------------------------------------------------------------------------------------
            // Stock Number iteration.... 
            $row = mysql_fetch_assoc($result);
            
            $currentSRNum = (int)(substr($row['sr_number'],0,3));
            
            $currentSRYear  = (int)(substr($row['sr_number'],2,2));
            $currentSRMonth = (int)(substr($row['sr_number'],0,2));
            $currentSRNum = (int)(substr($row['sr_number'],6,4));

            $currentYear  = (int)(date('y'));
            $currentMonth = (int)(date('m'));
            $currentDay = (int)(date('d'));
           
            $currentSRYMD = substr($row['sr_number'], 0, 6);
            $currentYMD = date("ymd");
            if ($currentYMD > $currentSRYMD) 
            {  
                $currentSRNum = 1;
            } 
            else 
            {  
                $currentSRNum += 1;
            }                                           
        }
//------------------------------------------------------------------------------------------------------------------         
        $yearMonth = date('ymd');    
        $currentSR = $currentYMD . sprintf("%04d", $currentSRNum);  
?>
<html>
<title>Receiving Materials</title>
<head>
<link rel="stylesheet" type="text/css" href="kanban.css" />
<style type="text/css">
#SR_date{
    position: relative;
    font-family: Arial, Helvetica, sans-serif;
    font-size: .9em;
    margin-left: 10px;
    width: auto;
    height: auto;
    float: left;
    top : 10px;
    
}
</style>


</head>
<body>
<form name="receiving_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">      

<div id="SR_date">
<label>Date :</label>
<input type="text" name="sr_date" value="<?php echo $sr_date; ?>" size="16" readonly="readonly" style="border: none;">    
</div>
<div id="SR_number">
<label>RM# :</label>
<input type="text" name="sr_number" value="<?php echo $currentSR; ?>" size="9" readonly="readonly" style="font-weight: bold; border: none;"> 
</div> 
<div id="SI_number">
<label class="LLabelRM">SI/DR# :</label>
<input type="text" name="si_num" id="si_num" class="LFieldRM" value="" size="25"> <br/></br/>
<label class="LLabelRM">Supplier Name :</label>
<input type="text" name="s_name" id="s_name" class="LFieldRM" value="" size="25">  <br/></br/>
<label class="LLabelSecRM">PO # :</label>
<input type="text" name="po_num" id="po_num" class="LFieldSecRM" value="" size="25">
<label class="LLabelSecRM">Quantity :</label>
<input type="text" name="qty" id="qty" class="LFieldSec1RM" value="" size="25"> <br/> <br/>
<label class="LLabelSecRM">Material Code :</label>
<input type="text" name="mat_code" id="mat_code" class="LFieldSecRM" value="" size="25">
<label class="LLabelSecRM">Material Desc. :</label>
<input type="text" name="mat_desc" id="mat_desc" class="LFieldSec1RM" value="" size="25">  <br/></br/>
<label class="LLabelSecRM">WH Code :</label>
<input type="text" name="wh_code" id="wh_code" class="LFieldSecRM" value="" size="25">
<label class="LLabelSecRM">BIN Location :</label>
<input type="text" name="bin_loc" id="bin_loc" class="LFieldSec1RM" value="" size="25">
</div> 
</form>
</body>
</html>
