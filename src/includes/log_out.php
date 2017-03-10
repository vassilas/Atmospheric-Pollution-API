<?php
//LOG OUT
	session_start();
	$_SESSION['user_api_key'] = '' ;
	$_SESSION['logged_in'] = false ;
	$_SESSION['is_admin'] = false ;
	
	$json = array();
	$json[]= array(
				'msg' => 'LOG OUT !'
	);
	$jsonstring = json_encode($json);
	echo $jsonstring ;
?>