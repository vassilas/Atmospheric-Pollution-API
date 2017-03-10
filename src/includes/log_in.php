<?php


/*	LOG_IN USER
	
	TABLE NAME : users
	COLUMNS	: id(int 11), email(varchar 30), passwd(varchar 30), api_key(char 32)
	
*/
	require("session_init.php");
	require("mysql_conn.php");

	
	if(! get_magic_quotes_gpc){
		//$id = addcslashes($_POST['id']);
		$email = addcslashes($_GET['log_in_email']);
		$passwd = addcslashes($_GET['log_in_passwd']);
	}else {
		//$id = $_POST['id'];
		$email = $_GET['log_in_email'];
		$passwd = $_GET['log_in_passwd'];
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db($database);
	
	//echo "<br />email : ".$email ;
	//echo "<br />password : ".$passwd ;
	
	$sql = "SELECT api_key FROM users WHERE email='$email' AND passwd='$passwd' ";
	$retval = mysql_query($sql,$conn);

	//$row = mysql_fetch_array($retval, MYSQL_ASSOC);
	//$return_email_value = $row['email'] ;
	$json = array();
	$number_of_rows = mysql_num_rows($retval); 

	if( $number_of_rows ){
		// logged in
		//echo "<br />LOGGED IN";
		//mysql_free_result($retval);
		$row = mysql_fetch_assoc( $retval );
		
		//echo "<br />".$email ;
		//echo $row['api_key'];
		$_SESSION['user_api_key'] = $row['api_key']; ;
		$_SESSION['logged_in'] = true ;
		if(!strcmp($email,"admin"))$_SESSION['is_admin'] = true ;
		$json[]= array(
				'msg' => 'LOGGED_IN'
		);
		
		//echo "<br />api_key : ". $_SESSION['user_api_key'] ;
		//echo "<br />LOG_IN : ". $_SESSION['logged_in'] ;
		//echo "<br />LOGED_IN !";
	}else {
		// DO NOT REGISTER
		//echo "Sorry !";
		$json[]= array(
				'msg' => 'LOG_IN_FAILD'
		);
	}
	
	
	$jsonstring = json_encode($json);
	echo $jsonstring ;
	
	
	mysql_close($conn);
?>