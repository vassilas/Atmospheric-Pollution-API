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
		
		$pollution_type = $_GET['pollution_type3'];
		$station_code = $_GET['station_code3'];
		$year = $_GET['year3'];
		$month = $_GET['month3'];
		$day = $_GET['day3'];

		$extend1 = "" ;
		if($station_code)
		{
			$extend1 = "WHERE code = '$station_code' ";

		}
		$extend2 = "" ;
		if($year)
		{	
			$extend2 = $extend2." AND year = '$year' ";

		}
		if($month)
		{
			$extend2 = $extend2." AND month =  '$month' ";

		}
		if($day)
			$extend2 = $extend2." AND day =  '$day' ";
		
		require("mysql_conn.php");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database);
		
		$sql_query = "INSERT INTO requests (req_id,user_api_key,type) 
		VALUES(NULL,'$user_api_key','request_3')";
		$retval = mysql_query($sql_query,$conn);
		
		$my_sql = "SELECT * FROM stations ".$extend1 ;
		$retval = mysql_query( $my_sql, $conn );
		$cnt = 0;
		while( $row = mysql_fetch_array($retval) )
		{	
		
	
			$station_id = $row['id'];
			$latitude = $row['latitude'];
			$longitude = $row['longitude'];
			
		
			$avarage_value = 0 ;
			$standard_deviation = 0.0 ;
			$absolute_value = 0.0 ;
			$count = 0 ;
			$absolute_value_array = array() ;
			
			$sql = "SELECT measure 
					FROM measurements 
					WHERE station_id = '$station_id'
					AND pollution_type = '$pollution_type'
					".$extend2 ;
			$retval2 = mysql_query( $sql, $conn );
			
			
			while( $row2 = mysql_fetch_array($retval2) )
			{
				$measure = $row2['measure'] ;
				$array[] = str_getcsv($measure,',',' ') ;
				$hour = 1 ;
				for($hour=1;$hour<=24;$hour++)
				{
					$absolute_value = $array[$cnt][$hour] ;
					if( $absolute_value != -9999 )
					{
						$avarage_value = $avarage_value + $absolute_value ;
						$count = $count + 1 ;
						$absolute_value_array[$count] = $absolute_value ;

					}
				
				}
				$cnt++;
			}
			
			
			if($count == 0)$count=1;
			
			$avarage_value = $avarage_value/$count ;
			for($i=0;$i<$count;$i++)
			{
				$standard_deviation = $standard_deviation + pow(($absolute_value_array[$i] - $avarage_value),2);
			}
			$standard_deviation = $standard_deviation/$count ;
			$standard_deviation = sqrt($standard_deviation) ;
			
			$json[]= array
			(
			'standard_deviation' => $standard_deviation ,
			'avarage' => $avarage_value ,
			'latitude' => $latitude,
			'longitude' => $longitude
			);

		}

		
		$jsonstring = json_encode($json);
		echo $jsonstring ;
		
		
	}else {
		echo "<br/ > NOT LOGGED IN";
	}
	
?>