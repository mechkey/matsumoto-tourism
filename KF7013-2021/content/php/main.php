<?php

	$connection = mysqli_connect ('localhost', 'root', 'root', 'zoo');
	if($connection) {
		mysqli_set_charset($connection, 'utf8');
	}

	if($connection === false) {
		echo "<p>Connection failed:" . mysqli_connect_error() . " </p>\n";
	}

	
	$themeType = '';
	$changeTheme = '';

	if ((isset($_GET['theme'])) && ($_GET['theme'] == 'dark')) {
		$themeType = 'dark';
	} else {
		$themeType = 'light';
	}



?>
