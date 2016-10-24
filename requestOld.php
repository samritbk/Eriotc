<?php

	mysql_connect("localhost","root","");
	mysql_select_db("temherti");
	
	if(isset($_GET['app_id'])){
		if(isset($_GET['mode'])){
			switch($_GET['mode']){
				case "genzeb_req":
					echo getGenzeb();
				break;
				case "insertData":
					if(isset($_GET['CN'],$_GET['A'],$_GET['P'],$_GET['S'])){
						
						echo insertData($_GET['CN'],$_GET['A'],$_GET['P'],$_GET['S']);
						
					}
				break;
			}
			
		}
	}
	
	function insertData($customerName,$amount,$paid,$stage){
		$return=array();
		
		if($customerName != NULL  && $amount != NULL && $paid != NULL && $stage != NULL){
			$customerName=urldecode($customerName);
			$query=mysql_query("INSERT INTO genzeb (person_name,amount,paid,stage) VALUES ('$customerName','$amount','$paid','$stage')");
			
			if($query){
				$last_id=mysql_insert_id();
				$return['error']=0;
				$return['success_msg']="Successfully Added";
				$return['last_id']=$last_id;
			}else{
				$return['mysql_error']=mysql_error();
				$return['error']=1;
				$return['err_msg']="Oops !! Problem Adding";
			}
		}else{
			$return['error']=1;
			$return['err_msg']="Oops !! Empty data";
		}
		
		echo json_encode($return);
	}
	function getSebket($id=0){
		
		$return=array();
		
		if($id != 0){
			$query=mysql_query("SELECT * FROM sebket WHERE sebket_id=$id");	
		}else{
			$query=mysql_query("SELECT * FROM sebket");	
		}
		
		$num_query=mysql_num_rows($query);
		
		if($num_query != 0){
		
			while($row=mysql_fetch_assoc($query)){
				
				$return[]=array(
					"sebket_id"=>$row['sebket_id'],
					"sebket_name"=>$row['sebket_name'],
					"by"=>$row['by'],
					"date_recorded"=>$row['date_recorded']
				);
				
			}
			$return['count']=$num_query;
		}
		
		return json_encode($return);
	}
	
	
	function getGenzeb($id=0){
		
		$return=array();
		
		if($id != 0){
			$query=mysql_query("SELECT * FROM genzeb WHERE genzeb_id=$id");	
		}else{
			$query=mysql_query("SELECT * FROM genzeb");	
		}
		
		$num_query=mysql_num_rows($query);
		
		if($num_query != 0){
		
			while($row=mysql_fetch_assoc($query)){
				
				$return[]=array(
					"genzeb_id"=>$row['genzeb_id'],
					"person_name"=>$row['person_name'],
					"amount"=>$row['amount'],
					"paid"=>$row['paid'],
					"stage"=>$row['stage']
				);
				
			}
			$return['count']=$num_query;
		}
		
		return json_encode($return);
	}
	
?>