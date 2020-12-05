<?php
	//Connect to database
	$connection = mysqli_connect ('localhost', 'root', 'root', 'zoo');
	if ($connection) {
		mysqli_set_charset($connection, 'utf8');
	}

	if ($connection === false) {
		echo "<p>Connection failed:" . mysqli_connect_error() . " </p>\n";
	}

	//Init path var
	/*
	function getmpath() {
		$mpath = $_SERVER['REQUEST_URI'];
		return $mpath		
	}
	*/

	function getpath() {
		$path = $_SERVER['REQUEST_URI'];
		return $path;
	}

	//

	function getroot($page) {;
		if (preg_match('/\.\/content\/php/', $page)) {
			return '../../';
		} else if (preg_match('/\.\/content/', $page)) {
			return '../';
		} else if (preg_match('/index\.php/', $page)) {
			return './';
		}
	}

	//Init dark mode vars

	$themeType = '';
	//$_SESSION['themeType'] = '';
	$changeTheme = '';
	//If 
	if (((isset($_REQUEST['theme'])) && ($_REQUEST['theme'] == 'dark'))) {
		$_SESSION['themeType'] = 'dark';
	} else if ((isset($_REQUEST['theme'])) && ($_REQUEST['theme'] == 'light')) {
		$_SESSION['themeType'] = 'light';
	} 

	function classID() {
		if (isset($_SESSION['themeType'])) {
			echo $_SESSION['themeType'];
		}
	}


	//The website logo light mode and dark mode selector.
	function showLogo ($path) {
		$logosrc = ''; 	
		if (isset($_SESSION['themeType']) && $_SESSION['themeType'] == 'dark') { 		
			$logosrc = '/assets/images/logogray.png'; 	
		} else { 
			$logosrc = '/assets/images/logo.png';
		}
		
		echo '<li><a href="../index.php"><img id="logo" src="' . $logosrc . '" alt="Visit Matsumoto Logo" height="30"/></a></li>';
		
	}

	function navbarloginform () {
		$login = '
		<li>
		<form id="login" method="post" action="/content/php/dologin.php"> 
		Username:    
		<input type= "text" name="username" size="8" /><br />
		Password:
		<input type= "password" name="password" size="8" /> </li>
		<input type="submit" value="Login" /> 
		</form>
		';
		echo $login;
	}


	function navbarlogoutform () {
		$logout = '
		<form id="logout" method="post" action="/content/php/dologout.php"> 
		<input type="submit" value="Logout" /> 
		</form>
		';
		echo $logout;
	}
	
 /*
	function navbarloginform ($fpath) {
		$login = '
		<li>
		<form id="login" method="post" action="' . getroot($fpath) . 'content/php/dologin.php"> 
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
		<form id="logout" method="post" action="' . getroot($fpath) . 'content/php/dologout.php"> 
		<input type="submit" value="Logout" /> 
		</form>
		';
		echo $logout;
	}

	*/

	function loginpageform() {
		$login = '
		<li>
		<form id="login" method="post" action="./php/dologin.php"> 
		Username:    
		<input type= "text" name="username" size="8" /><br />
		Password:
		<input type= "password" name="password" size="8" /> </li>
		<input type="submit" value="Login" /> 
		</form>
		';
	echo $login;
	}



	function logoutform() {
		$fpath = '';
		$logout = '
		<form id="logout" method="post" action="php/dologout.php"> 
		<input type="submit" value="Logout" /> 
		</form>
		';
		echo $logout;
	}

	



/*
	function getroot($page) {
		echo ;
		if (preg_match('/content/', getpath($page))) {
			return '../';
		} else if (preg_match('/php/', getpath($page))) {
			return '../../';
		} else if (preg_match('/index/', getpath($page))) {
			return './';
		}
	}

	*/



	function br() {
		echo "<br />";

	}

?>