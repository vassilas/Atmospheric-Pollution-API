<?php
/* INSERT DATA - STATION */
/*
	TABLE NAME: stations
	COLUMNS : id (int 11), code (varchar 5) , name (varchar 30) 
	
	TABLE NAME: coordinates
	COLUMNS: id (int 11), latitude (decimal 18,14) , longitude (decimal 18,14)
	
*/

	require('session_init.php');
	
	if( $_SESSION['is_admin'] && $_SESSION['logged_in'] ){
		require("mysql_conn.php");

		if(! get_magic_quotes_gpc){
			//$station_id = addslashes($_POST['id']);
			$station_code = addcslashes($_POST['code']);
			$station_name = addcslashes($_POST['name']);
			
			/*$coordinates_id = $station_id ;*/
			$coordinates_latitude = addcslashes($_POST['latitude']);
			$coordinates_longitude = addcslashes($_POST['longitude']);
		}else {
			//$station_id = $_POST['id'];
			$station_code = $_POST['code'];
			$station_name = $_POST['name'];
			
			//$coordinates_id = $station_id ;
			$coordinates_latitude = $_POST['latitude'];
			$coordinates_longitude = $_POST['longitude'];
		}
		
		mysql_query("SET NAMES 'utf8'");

		mysql_select_db($database);
		$sql_query = "INSERT INTO stations (id,code,name,latitude,longitude) VALUES(NULL,'$station_code','$station_name','$coordinates_latitude','$coordinates_longitude')";
		$retval = mysql_query( $sql_query, $conn );
		
		if(! $retval ) {
			die('Could not enter data to Station_Table : ' . mysql_error());
		}else{
			echo "<h1>Instert Station Success</h1>";
		}

		mysql_close($conn);
	}else {
		echo "<br/ > NOT LOGGED IN";
	}
?>