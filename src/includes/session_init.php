<?php
/* SESSION INIT */

	session_start();
	
	if( !isset( $_SESSION['user_api_key']) ){
		$_SESSION['user_api_key'] = '' ;
	} 
	
	if( !isset( $_SESSION['logged_in']) ){
		$_SESSION['logged_in'] = false ;
	}
	
	if( !isset( $_SESSION['is_admin']) ){
		$_SESSION['is_admin'] = false ;
	}

?>