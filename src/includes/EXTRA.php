<?php

	require("mysql_conn.php");
	require("session_init.php");
	
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db($database);
	
	$number_of_rows = 0 ;
	$user_api_key  = '' ;
	
	if( $_SESSION['logged_in']  )
	{
		$user_api_key =  $_SESSION['user_api_key'] ;
	}
	else 
	{
		$user_api_key = $_GET['api_key'];
	
		$sql_check_APIkey = " SELECT api_key FROM users WHERE  api_key = $user_api_key " ;
		
		$retval = mysql_query($sql_check_APIkey , $conn);
		
		$number_of_rows = mysql_num_rows($retval); 
	}
	
	
	if( $_SESSION['logged_in'] || $number_of_rows )
	{
		// CODE 
	}
	
	mysql_close($conn);
	
?>