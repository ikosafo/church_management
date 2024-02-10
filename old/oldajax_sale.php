<?php 
include('config.php');


$_SESSION['user_id'] = '7';

if(isset($_POST['bar_code']) AND !empty($_POST['bar_code'])){
	    
	    $sqlCheck = $mysqli->query("SELECT invoice_id FROM invoices WHERE invoice_id = '".$_POST['invoice_id']."'");
    	$numCheck = $sqlCheck->num_rows;
    	if($numCheck <= 0){
	
        	$last_bill_no = $mysqli->query("SELECT MAX(id + 1) AS bill_no FROM invoices");
        	$bill_no = $last_bill_no->fetch_array();
        	
        	$user_sql = $mysqli->query("SELECT name FROM users WHERE id = '".$_SESSION['user_id']."'");
        	$user_name = $user_sql->fetch_array();
        	
        	$sqlN = '';$sum=0; 
        	$printData = '<table cellpadding="0" cellspacing="0" style="width:100%" id="invoice_table">
        	<tr><th colspan="6" class="border_dotted" style="text-align:center;">SHOP BILLING <BR/>AGS DAIRIES LLP <br/>TAX INVOICE / BILL OF SUPPLY</th></tr>
        	<tr><th colspan="3">POS : '.$_SESSION['user_id'].' ('.$user_name.')</th><th colspan="3">No. : '.$bill_no['bill_no'].'</th></tr>
        	<tr><th colspan="3" class="border_dotted"> '.date('d-m-Y').'</th><th colspan="3" class="border_dotted"> '.date('h:i:s A').'</th></tr>
        	<tr><th class="border_dotted">Sr. No.</th><th class="border_dotted">MRP</th><th class="border_dotted">Rate</th><th class="border_dotted">Qty.</th><th class="border_dotted">GST %</th><th class="border_dotted" style="text-align:right;">Amt.</th></tr>';
        	for($i= 0;$i < sizeof($_POST['bar_code']);$i++){
        		if(!empty($_POST['bar_code'][$i])){
        			
        			$sqlH = $mysqli->query("SELECT hsn_code,igst FROM product WHERE bar_code = '".$_POST['bar_code'][$i]."'");
        			$rowH = $sqlH->fetch_array();
        			
        			$mysqli->query("UPDATE product SET unit = (unit - '".$_POST['quantity'][$i]."') WHERE name = '".$_POST['name'][$i]."'");
        			$sqlN .= "('','".$_POST['bar_code'][$i]."','".$_POST['name'][$i]."','".$_POST['mrp'][$i]."','".$_POST['sale_price'][$i]."','".$_POST['quantity'][$i]."','".$rowH['igst']."','".$_POST['user_id']."','".$_POST['invoice_id']."','".$_POST['payment_method']."','".date('Y-m-d H:i:s')."'),";
        			$sum += $_POST['sale_price'][$i];
        			$saved_price += (($_POST['mrp'][$i] * $_POST['quantity'][$i]) - $_POST['sale_price'][$i]);
        			$printData .= '<tr><td>'. $sr = $i+1 .'</td><td colspan="2">'.$_POST['name'][$i].'</td><td colspan="3">'.$rowH['hsn_code'].'</td></tr>';
        			$printData .= '<tr><td></td><td>'.$_POST['mrp'][$i].'</td><td>'.$_POST['sale_price_org'][$i].'</td><td>'.$_POST['quantity'][$i].'</td><td>'.$rowH['igst'].'</td><td>'.$_POST['sale_price'][$i].'</td></tr>';
        			
        		}
        	}
        	$insertValuesSQL = trim($sqlN,',');
        	$nSql = "INSERT INTO sale VALUES $insertValuesSQL";
        	$mysqli->query($nSql);
        	$printData .= '<tr><td colspan="5" class="border_dotted border_dotted_top">Total</td><td class="border_dotted border_dotted_top">'.round($sum).'</td></tr>';
        	$printData .= '<tr><th class="border_dotted">GST %</th><th colspan="2" class="border_dotted">Taxable Amt.</th><th class="border_dotted">CGST</th><th class="border_dotted">SGST</th><th class="border_dotted" style="text-align:right;">Total</th></tr>';
        	$imp = "'" . implode ( "', '", $_POST['name'] ) . "'";
        	$sqlS = $mysqli->query("SELECT igst,SUM(sale_price) AS sum_sale_price FROM sale WHERE invoice_id = '".$_POST['invoice_id']."' GROUP BY igst");
        	while($rowS = $sqlS->fetch_array()){
        		
        		$taxablee =  number_format((floatval($rowS['sum_sale_price'])/(($rowS['igst']/100) + 1)),2);
        		$cgste = number_format(($rowS['sum_sale_price'] - $taxablee)/2,2);
        		$sgste = number_format(($rowS['sum_sale_price'] - $taxablee)/2,2);
        		$printData .= '<tr><td>'.$rowS['igst'].'</td><td colspan="2">'. $taxablee .'</td><td>'. $cgste .'</td><td>'. $sgste .'</td><td>'.number_format($rowS['sum_sale_price'],2).'</td></tr>';
        	}
        
        	$printData .= '<tr><td colspan="6" class="border_dotted border_dotted_top" style="text-align:center;">You Have Saved Today '.round($saved_price).'</td></tr><tr><td colspan="6" class="border_dotted" style="text-align:center;">THANKS FOR YOUR VISIT</td></tr></table>';
        	
        	$mysqli->query("INSERT INTO invoices VALUES('','".$_POST['invoice_id']."','".$_POST['user_id']."','".round($sum)."','".$_POST['payment_method']."','".date('Y-m-d H:i:s')."')");
        	if($mysqli->insert_id){
        		echo $printData;
        	}
    	}else{
    		echo "ERROR";
    	}	
}
?>