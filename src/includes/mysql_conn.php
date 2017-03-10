<?php

$server = 'localhost' ;
$user = 'vassilas_web2016' ;
$passwd = 'web2016project' ;
$database = 'vassilas_web2016';

$conn = mysql_connect($server, $user, $passwd ,$database);

if(! $conn ){
	die('Could not connect : '. mysql_error());
}

//echo 'Connected successfully';

mysql_query("SET NAMES 'utf8'");


//mysql_close($conn);


?>