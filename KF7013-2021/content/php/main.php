<?php
	//Connect to database
	$connection = mysqli_connect ('localhost', 'root', 'root', 'zoo');
	if($connection) {
		mysqli_set_charset($connection, 'utf8');
	}

	if($connection === false) {
		echo "<p>Connection failed:" . mysqli_connect_error() . " </p>\n";
	}

	//Init path var
	/*
	function getmpath() {
		$mpath = $_SERVER['REQUEST_URI'];
		return $mpath		
	}
	*/

	//Init dark mode vars
	$themeType = '';
	$changeTheme = '';
	//If 
	if ((isset($_GET['theme'])) && ($_GET['theme'] == 'dark')) {
		$themeType = 'dark';
	} else {
		$themeType = 'light';
	}

function navbarloginform ($fpath) {
	$login = '
	<li>
	<form id="login" method="post" action="' . $fpath . 'php/dologin.php"> 
	Username:    
	<input type= "text" name="username" size="8" /><br />
	Password:
	<input type= "password" name="password" size="8" /> </li>
	<input type="submit" value="Login" /> 
	</form>
	';
	echo $login;
}

function navbarlogoutform ($fpath) {
	$logout = '
	<form id="logout" method="post" action="' . $fpath . 'php/dologout.php"> 
	<input type="submit" value="Logout" /> 
	</form>
	';
	echo $logout;
}


function loginform () {
	$login = <<<FORM
	<form id="login" method="post" action="./content/php/dologin.php"> 
	Username:    
	<input type= "text" name="username" size="8" /><br />
	Password:
	<input type= "password" name="password" size="8" />
	<input type="submit" value="Login" /> 
	</form>
FORM;
	echo $login;
}


function logoutform () {
	$fpath = '';
	$logout = '
	<form id="logout" method="post" action="' . $fpath . 'php/dologout.php"> 
	<input type="submit" value="Logout" /> 
	</form>
	';
	echo $logout;
}
?>