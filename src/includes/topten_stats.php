<?php
	//DISPLAY STATS FOR ADMIN ONLY
	
	require('session_init.php');
	

	if( $_SESSION['is_admin'] && $_SESSION['logged_in'] )
	{
		require("mysql_conn.php");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database);
		
		$my_sql =  "SELECT COUNT(user_api_key) , user_api_key 
					FROM requests 
					GROUP BY user_api_key 
					ORDER BY COUNT(user_api_key) DESC" ;
		$retval = mysql_query( $my_sql, $conn );
		
		$json = array();
	
		while($row = mysql_fetch_array($retval))     
		{
			
			$json[]= array(
				'user_api_key' => $row['user_api_key'],
				'count' => $row['COUNT(user_api_key)']
			);
		}
		
		$jsonstring = json_encode($json);
		echo $jsonstring;
			
		mysql_close($conn);
	}
?>	