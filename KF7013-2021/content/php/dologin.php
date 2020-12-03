<?php
	session_start();
	session_regenerate_id();
	$_SESSION['username'] = $_REQUEST['username'];
	header('Location: ../account.php');
	//or not header('Location: login.php');

?>