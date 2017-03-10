<?php

	/*
		UPLOADING THE FILE 
		INSERT IT TO THE MEASURMENT DATABASE 
		
		DATABASE : measurements
		TABLES : id(INT 11) ,station_id(INT 11) ,pollution_type(ENUM) ,date(DATE) ,measure(TEXT)
		
		ENUM VALUES: CO , NO , NO2 , O3 , SO2 , NOX , Smoke 
	
	*/
	
	// #######################
	// UPLOAD
	// #######################
	require('session_init.php');
	
	if( $_SESSION['is_admin'] && $_SESSION['logged_in'] ){
		
		$target_path = "../uploads/";
		/* Add the original filename to our target path.Result is "uploads/filename.extension" */
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
			echo "<h2>The file <font color='red'>".  basename( $_FILES['uploadedfile']['name']). 
			"</font> has been uploaded </h2><br />";
		} else{
			echo "There was an error uploading the file, please try again!";
		}
		
		//$filename = basename( $_FILES['uploadedfile']['name']) ;
		$file = fopen($target_path,"a+");
		$size = filesize($target_path);
		$lines = 0 ;
		
		
		$text = fread($file,$size);
		fclose($file);
		
		/*
		for( $index = 0 ; $index <= $size ; $index++ )
		{
			if( $text[$index] == "\n" ){
				echo "<br />";
				$lines++;
			}
			else 
				print($text[$index]);
		}
		echo "<br />";
		print("lines : ".$lines);
		*/
		
		// #######################
		// MYSQL INSERT
		// #######################
		
		
		require("mysql_conn.php");
		
		if(! get_magic_quotes_gpc){
			$station_code = addcslashes($_POST['station_code']);
			//$year = addcslashes($_POST['year']);
			$pollution_type = addcslashes($_POST['pollution_type']);
			
		}else {
			$station_code = $_POST['station_code'];
			//$year = $_POST['year'];
			$pollution_type = $_POST['pollution_type'];
		}
		
		
		$lines = explode(PHP_EOL, $text);
		$array = array();
		$index = 0 ;
		
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($database);
		
		$sql = "SELECT id FROM stations WHERE code = '$station_code' ";		
		$retval = mysql_query( $sql, $conn );
		$row = mysql_fetch_array($retval);
		$station_id = $row['id'];
		
		foreach($lines as $line)
		{
			$array[] = str_getcsv($line,'"',' ');
			$date = $array[$index][1];
			$measure = $array[$index][2];
			
			$array2[] = str_getcsv($date,'-',' ');
			$year = $array2[$index][2];
			$month = $array2[$index][1];
			$day = $array2[$index][0];
			
			$sql_query = "INSERT INTO measurements (id,station_id,pollution_type,year,month,day,measure) VALUES(NULL,'$station_id','$pollution_type','$year','$month','$day','$measure')";
			$retval = mysql_query( $sql_query, $conn );
		
			if(! $retval ) {
				die('Could not enter data to Station_Table : ' . mysql_error());
			}
				
			$index++;
		}
		
		mysql_close($conn);
		
		
	}else {
		echo "<br /> NOT LOGGED IN" ;
	}
	
	
	
	
	//print_r($array);
	//echo "<br />".$index ;
	
	//echo count($array);
	
	
	/*
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db($database);
	
	
	for( $index = 0 ; $index <= $size ; $index++ )
	{
		if( $text[$index] == "\n" ){
			$sql_query = "INSERT INTO measurements (id,station_id,pollution_type,date,measure) VALUES(NULL,'$station_id','$pollution_type','$date','$measure')";
			$retval = mysql_query( $sql_query, $conn );
	
			if(! $retval ) {
				die('Could not enter data to Station_Table : ' . mysql_error());
			}
			$lines++;
			$date="";
			$measure="";
		}
		else 
			//$date = $date.+++
			//$measure = $measure.+++
			print($text[$index]);
	}
	
	
	
	
	
	$sql_query = "INSERT INTO measurements (id,station_id,pollution_type,year,date,measure) VALUES(NULL,'$station_id','$pollution_type','$year','$date','$measure')";
	$retval = mysql_query( $sql_query, $conn );
	
	if(! $retval ) {
		die('Could not enter data to Station_Table : ' . mysql_error());
	}
	
	
	mysql_close($conn);
	
	*/
?>