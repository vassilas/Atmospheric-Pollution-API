<?php
/*	REGISTER USER
	
	TABLE NAME : users
	COLUMNS	: id(int 11), email(varchar 30), passwd(varchar 30), api_key(char 32)
	
*/

	require("mysql_conn.php");
	
	if(! get_magic_quotes_gpc){
		//$id = addcslashes($_POST['id']);
		$email = addcslashes($_GET['register_email']);
		$passwd = addcslashes($_GET['register_passwd']);
	}else {
		//$id = $_POST['id'];
		$email = $_GET['register_email'];
		$passwd = $_GET['register_passwd'];
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db($database);
	
	$sql = "SELECT email FROM users WHERE email='$email' ";
	$retval = mysql_query($sql,$conn);
	
	// MD5 
	$api_key = md5($email."secret");
	//echo "<br />MD5=".$api_key;
	
	//$row = mysql_fetch_array($retval, MYSQL_ASSOC);
	//$return_email_value = $row['email'] ;
	$json = array();
	
	$number_of_rows = mysql_num_rows($retval); 
	
	if( $number_of_rows == 0 ){
		// REGISTER
		//echo "<h1><br />REGISTER<h1>";
		mysql_free_result($retval);
		$sql = "INSERT INTO users (id,email,passwd,api_key) VALUES (NULL,'$email','$passwd','$api_key')";
		$retval = mysql_query($sql,$conn);
		$json[]= array(
				'msg' => 'API key : '.$api_key 
		);
		
	}else {
		// DO NOT REGISTER
		//echo "<h1><br />DO NOT REGISTER <br />Email already exists !<h1>";
		$json[]= array(
				'msg' => 'NOT_REGISTER'
		);
	}
	
	$jsonstring = json_encode($json);
	echo $jsonstring ;
	
	
	
	mysql_close($conn);
?>

