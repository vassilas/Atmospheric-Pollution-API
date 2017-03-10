<?php
	require('session_init.php');
	
	if( $_SESSION['is_admin'] && $_SESSION['logged_in'] ){
		
		require("mysql_conn.php");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database);
		
		$station_code = $_GET['code'];
		$number_of_rows = false ;
		
		$sql_query = "DELETE FROM stations
					  WHERE code='$station_code'" ;
		$retval = mysql_query( $sql_query, $conn );
		if($retval)echo "<h1>Station deleted</h1>";
		
		
		mysql_close($conn);
	}
	
	
?>

