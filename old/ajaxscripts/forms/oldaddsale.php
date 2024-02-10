<?php 
include("../../config.php");

$last_bill_no = $mysqli->query("SELECT MAX(id + 1) AS bill_no FROM invoices");
$bill_no = $last_bill_no->fetch_array();
$invoice_id = $bill_no['bill_no'].'-'.uniqid();?>
<style type="text/css">
td:nth-child(2) {
    width: 30%;
}
</style>
<body class="animsition " onload="default_focus()">
  
  <?php //include("sidebar_top_menu.php");?>
  <!-- Page -->
  <div class="page">
	
    <div class="page-header">
      <h1 class="page-title">Billing</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Billing</li>
      </ol>
    </div>

    <div class="page-content container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <!-- Panel Standard Mode -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Add Product</h3>
            </div>
            <div class="panel-body">
			<?php //if(!empty($_SESSION['flash_msg'])) { echo $_SESSION['flash_msg']; $_SESSION['flash_msg'] = ''; } ?>
              <form class="form-horizontal00 billingForm" action="ajax_sale.php" method="POST" name="billingForm" id="dd" autocomplete="off">
				<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['username'];?>" />
				<input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $invoice_id;?>" />
				
				<table id="app">
					<thead>
						<th>Barcode</th>
						<th>Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Available <br/>Quantity</th>
						<th>Sale Price</th>
					</thead>
					<tbody>
					<tr id="1">
						<td>
							<input type="text" id="bar_code_1" required class="form-control" onkeypress="return RestrictSpace()" onchange="get_detail(this.value,1)" name="bar_code[]" />
						</td>
					<td>
						<select name="name[]" id="name_1" class="form-control" onchange="get_detail_name(this.value,1)">
							<option value="">Choose Product</option>
							<?php $sqlP = $mysqli->query("SELECT * FROM product WHERE status = 1 ORDER BY name");
							while($rowP = $sqlP->fetch_array()){?>
							<option value="<?php echo $rowP['name']?>"><?php echo $rowP['name'];?></option>
							<?php }?>
						</select>
					</td>
					
					<td>
						<input type="text" required class="form-control" readonly id="mrp_1" name="mrp[]" />
					</td>
					<td>	
						<input type="number" class="form-control" onkeyup="calculate_price(this.value,1)" step="0.001" id="quantity_1" name="quantity[]" />
					</td>
					<td>
						<input type="text" readonly class="form-control" id="av_quantity_1" name="av_quantity[]" />
					</td>
					<td>
						<input type="number" required class="form-control" onkeyup="get_quantity(this.value,1)" step="0.01" id="sale_price_1" name="sale_price[]" />
						<input type="hidden" class="form-control" id="sale_price_org_1" name="sale_price_org[]" />
						<input type="hidden" class="form-control" id="igst_1" name="igst[]" />
					</td>
				</tr>
				</tbody>
				<tfoot id="foot" style="margin-top:20px;">
					<tr>
						<td class="text-right"><b>Paid By : </b></td>
						<td > 
							<select name="payment_method" class="form-control" id="payment_method">
								<option value='cash'>Cash</option>
								<option value='card'>Card</option>
								<option value='paytm'>Paytm</option>
								<option value='phone_pay'>Phone Pay</option>
								<option value='google_pay'>Google Pay</option>
								<option value='upi'>UPI</option>
								<option value='udhar'>UDHAR</option>
								<option value='other'>Other</option>
							</select>
						</td>
						<td colspan="3" class='text-right'><b>Total : </b></td>
						<td><input type="number" class="form-control" readonly name="total" value="0" id="getTotal" /></td>
					</tr>
				</tfoot>
				</table>
                <div class="text-right">
                  <button type="submit" name="make_print" class="btn btn-primary" id="validateButton2">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- End Panel Standard Mode -->
		</div>
      </div>
    </div>
  </div>
  <!-- End Page -->

  
<script type="text/javascript">

$("#name_1").select2({
    placeholder:"Select Product",
    allowClear:true
})

function RestrictSpace() {
    if (event.keyCode == 32) {
        return false;
    }
}

function default_focus(){
	document.getElementById('bar_code_1').focus();
}

function get_detail(b,n){
	var nx = n+1;
	
	$.ajax({  
		type:"POST",  
		url:"ajax_product.php",  
		data:{bar_code:b,action_type:"get_detail"},
		success:function(data){
			var data = $.parseJSON(data);
			if(data.type == 'Success'){
				
				//Check Duplicate Value
				var barCode = document.querySelectorAll("#dd input[name='bar_code[]']");
				for(key=0; key < barCode.length - 1; key++)  {
					if(barCode[key].value == data.bar_code){
						alert("Already Exist");
						document.getElementById('bar_code_'+n).value = '';
						document.getElementById('bar_code_'+n).focus();
						return false;
					}					
				}
				
				var newRow = $('#app tbody').append('<tr id='+nx+'><td><input type="text"  class="form-control" onkeypress="return RestrictSpace()" onchange="get_detail(this.value,'+nx+')" id="bar_code_'+nx+'" name="bar_code[]" required /></td><td><select name="name[]" id="name_'+nx+'" class="form-control" onchange="get_detail_name(this.value,'+nx+')" required ><option value="">Choose Product</option><?php $sqlP = $mysqli->query("SELECT * FROM product WHERE status = 1 ORDER BY name ASC"); while($rowP = $sqlP->fetch_array()){?><option value="<?php echo $rowP['name'];?>"><?php echo $rowP['name'];?></option><?php }?></select></td><td><input type="text"  id="mrp_'+nx+'" readonly class="form-control" name="mrp[]" required /></td><td><input type="number" id="quantity_'+nx+'" step="0.001" class="form-control" onkeyup="calculate_price(this.value,'+nx+')" name="quantity[]" required /></td><td><input type="text" id="av_quantity_'+nx+'" readonly class="form-control" name="av_quantity[]" /></td><td><input type="number" id="sale_price_'+nx+'"  class="form-control" onkeyup="get_quantity(this.value,'+nx+')" name="sale_price[]" step="0.01" required /><input type="hidden" class="form-control" id="sale_price_org_'+nx+'" name="sale_price_org[]" /><input type="hidden" class="form-control" id="igst_'+nx+'" name="igst[]" /></td><td><a href="#" onclick="remove_data('+ nx +')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove">Delete</a></td></tr>');
				document.getElementById('name_'+n).value = data.name;
				document.getElementById('mrp_'+n).value = data.mrp;
				document.getElementById('quantity_'+n).value = 1;
				document.getElementById('av_quantity_'+n).value = data.av_quantity;
				document.getElementById('sale_price_'+n).value = data.sale_price;
				document.getElementById('sale_price_org_'+n).value = data.sale_price;
				document.getElementById('igst_'+n).value = data.igst;
				
				//Get Value For Total
				var salePrice = document.querySelectorAll("#dd input[name='sale_price[]']");
				var newA = [];
				for(key=0; key < salePrice.length; key++)  {
					if(salePrice[key].value != ''){
						newA.push(parseFloat(salePrice[key].value));
					}
				}
				var aac = newA.reduce(getSum);
				document.getElementById('getTotal').value = Math.round(parseFloat(aac));
				
				document.getElementById('bar_code_'+nx).focus();
			}else{
				alert("Barcode Not Found");
				document.getElementById('bar_code_'+n).value = '';
				document.getElementById('bar_code_'+n).focus();
				return false;
			}
		}  
	});
}

function get_detail_name(i,n){
	var nx = n+1;
	
	$.ajax({  
		type:"POST",  
		url:"ajax_product.php",  
		data:{name:i,action_type:"get_detail_by_name"},
		success:function(data){ 
			var data = $.parseJSON(data);
			if(data.type == 'Success'){
				
				//Check Duplicate Value
				var barCode = document.querySelectorAll("#dd input[name='bar_code[]']");
				for(key=0; key < barCode.length - 1; key++)  {
					if(barCode[key].value == data.bar_code){
						alert("Already Exist");
						return false;
					}					
				}
								
				//Appending New Row
				var newRow = $('#app tbody').append('<tr id='+nx+'><td><input type="text"  class="form-control" onkeypress="return RestrictSpace()" onchange="get_detail(this.value,'+nx+')" id="bar_code_'+nx+'" name="bar_code[]" required /></td><td><select name="name[]" id="name_'+nx+'" class="form-control" onchange="get_detail_name(this.value,'+nx+')" required ><option value="">Choose Product</option><?php $sqlP = $mysqli->query("SELECT * FROM product WHERE status = 1 ORDER BY name ASC"); while($rowP = $sqlP->fetch_array()){?><option value="<?php echo $rowP['name'];?>"><?php echo $rowP['name'];?></option><?php }?></select></td><td><input type="text"  id="mrp_'+nx+'" readonly class="form-control" name="mrp[]" required /></td><td><input type="number" id="quantity_'+nx+'" step="0.001" class="form-control" onkeyup="calculate_price(this.value,'+nx+')" name="quantity[]" required /></td><td><input type="text" id="av_quantity_'+nx+'" readonly class="form-control" name="av_quantity[]" /></td><td><input type="number" id="sale_price_'+nx+'" onkeyup="get_quantity(this.value,'+nx+')"  class="form-control" name="sale_price[]" step="0.01" required /><input type="hidden" class="form-control" id="sale_price_org_'+nx+'" name="sale_price_org[]" /><input type="hidden" class="form-control" id="igst_'+nx+'" name="igst[]" /></td><td><a href="#" onclick="remove_data('+ nx +')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove">Delete</a></td></tr>');
				document.getElementById('bar_code_'+n).value = data.bar_code;
				document.getElementById('mrp_'+n).value = data.mrp;
				document.getElementById('quantity_'+n).value = 1;
				document.getElementById('av_quantity_'+n).value = data.av_quantity;
				document.getElementById('sale_price_'+n).value = data.sale_price;
				document.getElementById('sale_price_org_'+n).value = data.sale_price;
				document.getElementById('igst_'+n).value = data.igst;
				
				//Get Value For Total
				var salePrice = document.querySelectorAll("#dd input[name='sale_price[]']");
				var newA = [];
				for(key=0; key < salePrice.length; key++)  {
					if(salePrice[key].value != ''){
						newA.push(parseFloat(salePrice[key].value));
					}
				}
				var aac = newA.reduce(getSum);
				document.getElementById('getTotal').value = Math.round(parseFloat(aac));
				
				document.getElementById('name_'+nx).focus();
			}else{
				alert("Prduct Not Found!");
			}
		}  
	});
}


function calculate_price(q,n){
	var sale_price_org = document.getElementById('sale_price_org_'+n).value;
	var sp = document.getElementById('sale_price_'+n).value;
	//var total = document.getElementById('getTotal').value;
	var gt = document.getElementById('sale_price_'+n).value = (sale_price_org * q).toFixed(2);
	
	
	var salePrice = document.querySelectorAll("#dd input[name='sale_price[]']");

	var newA = [];
	for(key=0; key < salePrice.length ; key++)  {
		if(salePrice[key].value != ''){
			newA.push(parseFloat(salePrice[key].value));
		}
	}
	
	//alert(newA);
	var aac = newA.reduce(getSum);
	document.getElementById('getTotal').value = Math.round(parseFloat(aac));
	//alert(aac);
	//document.getElementById('getTotal').value = Math.round((parseFloat(total) - parseFloat(sp)) + parseFloat(gt));
}

function getSum(total, num) {
  return parseFloat(total + num);
}
function get_quantity(p,n){
	
	var salePrice = document.querySelectorAll("#dd input[name='sale_price[]']");

	var newA = [];
	for(key=0; key < salePrice.length; key++)  {
		if(salePrice[key].value != ''){
			newA.push(parseFloat(salePrice[key].value));
		}
	}
	
	//alert(newA);
	var aac = newA.reduce(getSum);
	document.getElementById('getTotal').value = Math.round(parseFloat(aac));
	//alert(aac);
	
	
	var sale_price_org = document.getElementById('sale_price_org_'+n).value;
	var spgF = parseFloat(sale_price_org);
	var sp = document.getElementById('sale_price_'+n).value;
	var spF = parseFloat(sp);
	document.getElementById('quantity_'+n).value = (p/parseFloat(sale_price_org)).toFixed(3);
		
}

function remove_data(r){
	$('#'+r).remove();
	//Get Value For Total
	var salePrice = document.querySelectorAll("#dd input[name='sale_price[]']");
	var newA = [];
	for(key=0; key < salePrice.length; key++)  {
		if(salePrice[key].value != ''){
			newA.push(parseFloat(salePrice[key].value));
		}
	}
	var aac = newA.reduce(getSum);
	document.getElementById('getTotal').value = Math.round(parseFloat(aac));
	
}
</script>

<script type="text/javascript">
$(".billingForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
		type: "POST",
		url: "ajax_sale.php",
		data: form.serializeArray(), // serializes the form's elements.
		success: function(data){
			if(data != "ERROR"){
				var htmlToPrint = '' +
					'<style type="text/css">' +
					'#invoice_table th, #invoice_table td {' +
					'font-size:12px;' +
					'text-align:left;' +
					'}' +

					 '.border_dotted {' +
					'border-bottom:1px dashed #000' +
					'}' +
					
					 '.border_dotted_top {' +
					'border-top:1px dashed #000' +
					'}' +
					
					 '#invoice_table td:last-child {' +
					'text-align:right' +
					'}' +
					'</style>';
				htmlToPrint += data;
				
				newWin= window.open("");
				newWin.document.write(htmlToPrint);
				newWin.print();
				newWin.close();
				window.location.reload(true);
			}else{
				alert("Something Went Wrong, Please Try Again !");
			}
		}
	});
});

</script>
</body>
</html>