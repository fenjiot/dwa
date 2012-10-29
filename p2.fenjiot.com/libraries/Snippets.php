<?php
# Prevent SQL injection attacks by sanitizing the data the user entered in the form
$_POST = DB::instance(DB_NAME)->sanitize($_POST);

$q = 	"SELECT token
		FROM users
		WHERE email = '".$POST['email']."'
		AND password = ' ".$POST['password']."'
		";
		
$token = DB::instance(DB_NAME)->select_field($q);

?>