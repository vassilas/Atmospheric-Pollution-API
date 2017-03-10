<?php
	// DISPLAY USER REQUESTS
	
	require('session_init.php');
	
	if( $_SESSION['logged_in'] ){
		//USER
		
		require("mysql_conn.php");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database);
		
		$user_api_key = $_SESSION['user_api_key'];
		$sql = " SELECT type FROM requests WHERE user_api_key = '$user_api_key' " ;
		$retval = mysql_query( $sql, $conn );
		$json = array();
		
		$request1 = 0 ;
		$request2 = 0 ;
		$request3 = 0 ;
		
		while($row = mysql_fetch_array($retval))     
		{
			if( $row['type'] == 'request_1')$request1++;
			else if( $row['type'] == 'request_2')$request2++;
			else if( $row['type'] == 'request_3')$request3++;
		}
		
		$json[]= array(
			'request_1' => $request1,
			'request_2' => $request2,
			'request_3' => $request3,
			'user_api_key' => $user_api_key
		);
		
		$jsonstring = json_encode($json);
		echo $jsonstring;
		
		mysql_close($conn);
		
	}
?>