<?php
	session_start();
	$_SESSION['username'] = $_REQUEST['username'];
	session_regenerate_id();
	header('Location: ../account.php');
	//or not header('Location: login.php');

?>