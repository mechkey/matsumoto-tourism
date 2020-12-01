<?php
	session_start();
	$_SESSION['userName'] = $_REQUEST['userName'];
	header('Location: logged_in.php');
	or not header('Location: login.php');

?>