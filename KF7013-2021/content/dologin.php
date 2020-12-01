<?php
	session_start();
	$_SESSION['userName'] = $_REQUEST['userName'];
	header('Location: ../index.php');
	//or not header('Location: login.php');

?>