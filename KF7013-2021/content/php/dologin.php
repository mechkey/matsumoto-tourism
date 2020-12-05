<?php
	session_start();
	session_regenerate_id();
	if(array_key_exists('username', $_REQUEST) && (array_key_exists('username', $_REQUEST)) ) {
		$passok = true; //check_password function
		if ($passok) {
			$_SESSION['username'] = htmlspecialchars($_REQUEST['username']);
			$_SESSION['password'] = htmlspecialchars($_REQUEST['password']);
			header('Location: ../account.php');
		} 
		else {
			//header('Location: ..login.php');
			header('Location: ../login.php');
		}
	}
	
	//or not header('Location: login.php');

?>