<?php
	require('session_init.php');
	//$user_api_key = '';
	
	
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
		require("mysql_conn.php");
	
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database);
		
		
		$sql_query = "INSERT INTO requests (req_id,user_api_key,type) 
		VALUES(NULL,'$user_api_key','request_1')";
		$retval = mysql_query($sql_query,$conn);

		$sql = "SELECT code ,name, latitude, longitude FROM stations ";
		$retval = mysql_query($sql,$conn);
		
		if(! $retval ) 
		{
			//echo 'Could not display Station_Table : ' . mysql_error();
			
		}else {
			//echo 'SUCCESS !!!' ;
		}
		
		
		 // SEND DATA IN JSON
		
		$json = array();
		
		while($row = mysql_fetch_array($retval))     
		{
			$json[]= array(
				'code' => $row['code'],
				'name' => $row['name'],
				'latitude' => $row['latitude'],
				'longitude' => $row['longitude']
			);
		}

		$jsonstring = json_encode($json);
		echo $jsonstring;
		
		mysql_close($conn);
	}else {
		echo "<br/ > NOT LOGGED IN";
	}
	

?>

