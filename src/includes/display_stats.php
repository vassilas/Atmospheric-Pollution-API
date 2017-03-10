<?php
	//DISPLAY STATS FOR ADMIN ONLY
	
	require('session_init.php');
	

	if( $_SESSION['is_admin'] && $_SESSION['logged_in'] )
	{

		require("mysql_conn.php");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database);
		
		$my_sql = "SELECT api_key FROM users" ;
		$retval = mysql_query( $my_sql, $conn );
		
		$json = array();

		while($row = mysql_fetch_array($retval))     
		{
			$user_api_key = $row['api_key'];
			$sql = " SELECT type FROM requests WHERE user_api_key = '$user_api_key' " ;
			$retval2 = mysql_query( $sql, $conn );
			
			
			$request1 = 0 ;
			$request2 = 0 ;
			$request3 = 0 ;
			
			while($row2 = mysql_fetch_array($retval2))     
			{
				if( $row2['type'] == 'request_1')$request1++;
				else if( $row2['type'] == 'request_2')$request2++;
				else if( $row2['type'] == 'request_3')$request3++;
			}
			
			$json[]= array(
				'request_1' => $request1,
				'request_2' => $request2,
				'request_3' => $request3,
				'user_api_key' => $user_api_key
			);
			
		}
		
		$jsonstring = json_encode($json);
		echo $jsonstring;
			
		mysql_close($conn);
	}
?>