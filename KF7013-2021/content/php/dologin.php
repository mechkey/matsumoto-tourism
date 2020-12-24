<?php
	session_start();
	session_regenerate_id();
	include 'main.php';


	$user = htmlspecialchars(trim($_REQUEST['username']));
	$pass =  htmlspecialchars(trim($_REQUEST['password']));

	/*
	$pass = 'password';
	$hash = password_hash($pass, PASSWORD_DEFAULT);
	$check = password_verify($pass, $hash);
	echo $check;

	if(check) {
		echo 'check is 1/true';
	}
	*/

	login($user, $pass);

?>
