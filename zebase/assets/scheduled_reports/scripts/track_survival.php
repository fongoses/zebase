#!/usr/bin/php 
<?php
	$username_local = "root";
	$password_local = "raiQu2ai";
	$hostname_local = "localhost";
	$database_local = "fishDB"; 
	$local = mysql_connect($hostname_local, $username_local, $password_local) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_local, $local);
//survival rate track (takes a snapshot of the data at a given time)
	$query_Recordset = "select * from fish";
	$Recordset = mysql_query($query_Recordset, $local) or die(mysql_error()); 	 
	while($temp_object =  mysql_fetch_assoc($Recordset)){		 
		if ($temp_object['birthday']){
			//$date_array = explode('-',$temp_object['birthday']);	 
			/*$year = $date_array[0];
			$month = $date_array[1];
			$day = $date_array[2];  
			$birthday = mktime('1', '1', 0, $month, $day, $year);*/	
			$birthday = $temp_object['birthday'];		 
			$date_dif = (time() - $birthday) / (60 * 60 * 24);	
			 
				/*if($temp_object['current_adults'] > 0 && $temp_object['starting_adults'] > 0){
					if ($temp_object['starting_adults'] - $temp_object['current_adults'] == 0){
						$survival_percent = "1";
					}else{
						$survival_percent = ($temp_object['starting_adults'] - $temp_object['current_adults']) / $temp_object['starting_adults'];				 
					}
				}else{
					$survival_percent = "0";
				} */
				if($temp_object['starting_nursery'] == 0 || $temp_object['starting_nursery'] == ""){
					if($temp_object['starting_adults'] == 0 || $temp_object['starting_adults'] == ""){ 
						$survival_percent = 0;
					}else{
						$survival_percent = round($temp_object['current_adults'] / $temp_object['starting_adults'],2) * 100;
					}
				}else{
					$survival_percent = round($temp_object['current_adults'] / $temp_object['starting_nursery'],2) * 100;				
				}
				$sql = "insert into stat_survival_track values('','" . $temp_object['batch_ID'] . "','" . $temp_object['starting_adults'] . "','" . 
				$temp_object['current_adults'] . "','" . $temp_object['status'] . "','" . $survival_percent . "','" . $temp_object['birthday'] . "','" . time() . "','" . $temp_object['starting_nursery'] . "');";
 					if (mysql_query($sql, $local)) {
						$insertVar = "0";
					} else {
						echo $sql . ' <br>';					 		 
						die("Reason: " . mysql_error());		
					} 	 
 			 
		}
	}
	echo 'Report ran successfully!';
?>