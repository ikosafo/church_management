<?php 
include('config.php');
@extract($_REQUEST);
if(!empty($_POST['action_type'])){
	$action_type = $mysqli->real_escape_string($_POST['action_type']);
	switch($action_type){
		case "remove":
		if(!empty($_POST['id'])){
			$id = $mysqli->real_escape_string($_POST['id']);
			$sql = "DELETE FROM product WHERE id = '$id'";
			if($mysqli->query($sql)){
				echo "Product Has Been Deleted Successfully !";
			}else{
				echo "Something Went Wrong !";
			}
		}
		break;
		
		case "get_detail":
		if(!empty($_POST['bar_code'])){
			$bar_code = $mysqli->real_escape_string($_POST['bar_code']);
			$sql = $mysqli->query("SELECT * FROM product WHERE bar_code = '$bar_code'");
			$numRow = $sql->num_rows;
			if($numRow > 0){
				$row = $sql->fetch_array();
				$detail = array('type'=>'Success','bar_code'=>$row['bar_code'],'name'=>$row['name'],'mrp'=>$row['mrp'],'sale_price'=>$row['sale_price'],'av_quantity'=>$row['unit'],'igst'=>$row['igst']);
				echo json_encode($detail);
			}else{
				$detail = array('type'=>'Error');
				echo json_encode($detail);
			}
		}
		break;

		case "get_detail_by_name":
		if(!empty($_POST['name'])){
			$name = $mysqli->real_escape_string($_POST['name']);
			$sql = $mysqli->query("SELECT * FROM product WHERE name = '$name'");
			$numRow = $sql->num_rows;
			if($numRow > 0){
				$row = $sql->fetch_array();
				$detail = array('type'=>'Success','bar_code'=>$row['bar_code'],'mrp'=>$row['mrp'],'sale_price'=>$row['sale_price'],'av_quantity'=>$row['unit'],'igst'=>$row['igst']);
				echo json_encode($detail);	
			}else{
				$detail = array('type'=>'Error');
				echo json_encode($detail);
			}
			
		}
		break;
	
	}
}
?>