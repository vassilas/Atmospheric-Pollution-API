<?php
	require('session_init.php');
	
	if( !$_SESSION['logged_in'] ){
		$user_api_key = $_GET['api_key']; 
		
		require("mysql_conn.php");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database);
		
		$number_of_rows = 0 ;
		
		$sql_check_APIkey = " SELECT api_key FROM users WHERE  api_key = '$user_api_key' " ;
		if($retval = mysql_query($sql_check_APIkey , $conn))
		{
			$number_of_rows = mysql_num_rows($retval);
			if($number_of_rows==0)$user_api_key='';
		}
		
		mysql_close($conn);
	}
	else $user_api_key = $_SESSION['user_api_key'] ;
	if($user_api_key != ''){
	
		$pollution_type = $_GET['pollution_type2'];
		$station_code = $_GET['station_code2'];
		$year = $_GET['year2'];
		$month = $_GET['month2'];
		$day = $_GET['day2'];
		$hour = $_GET['hour2'];
		

		require("mysql_conn.php");
		
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database);
		
		$sql_query = "INSERT INTO requests (req_id,user_api_key,type) 
		VALUES(NULL,'$user_api_key','request_2')";
		$retval = mysql_query($sql_query,$conn);
		
		if( !$station_code ){
			$sql = "SELECT stations.latitude, stations.longitude, measurements.measure
					FROM stations
					INNER JOIN measurements ON stations.id = measurements.station_id
					WHERE measurements.year =  '$year'
					AND measurements.month =  '$month'
					AND measurements.day =  '$day'
					AND pollution_type =  '$pollution_type'
					";
			$retval = mysql_query($sql,$conn);
			if(! $retval ) {
				//echo 'Could not display Absolute Value : ' . mysql_error();
			}else {
				//	echo '<br/>SUCCESS !!!' ;
			}
			$json = array();
			$count = 0 ;
			while($row = mysql_fetch_array($retval))     
			{
				$measure = $row['measure'];
				$array[] = str_getcsv($measure,',',' ');
				$absolute_value = $array[$count][$hour];
				
				$json[]= array(
					'absolute_value' => $absolute_value,
					'latitude' => $row['latitude'],
					'longitude' => $row['longitude']
				);
				
				$count++ ;
			}
			
			$jsonstring = json_encode($json);
			echo $jsonstring ;

		}else {

			$sql = "SELECT stations.latitude, stations.longitude, measurements.measure
					FROM stations
					INNER JOIN measurements ON stations.id = measurements.station_id
					WHERE measurements.year =  '$year'
					AND measurements.month =  '$month'
					AND measurements.day =  '$day'
					AND pollution_type =  '$pollution_type'
					AND stations.code = '$station_code'
					";
			
			$retval = mysql_query($sql,$conn);

			if(! $retval ) {
				//echo 'Could not display Absolute Value : ' . mysql_error();
			}else {
				//	echo '<br/>SUCCESS !!!' ;
			}
	 
			$json = array();

			while($row = mysql_fetch_array($retval))     
			{
				$measure = $row['measure'];
				$array[] = str_getcsv($measure,',',' ');
				$absolute_value = $array[0][$hour];
				
				$json[]= array(
					'absolute_value' => $absolute_value ,
					'latitude' => $row['latitude'],
					'longitude' => $row['longitude']
				);
				
			}
			
			$jsonstring = json_encode($json);
			echo $jsonstring ;
		}	

		mysql_close($conn);
	}else {
		echo "<br/ > NOT LOGGED IN";
	}
	
?>