<?php
	//Connect to database

	$debug = false;

	$conn = mysqli_connect ('localhost', 'root', 'root', 'travel');
	if ($conn) {
		mysqli_set_charset($conn, 'utf8');
	}

	if ($conn === false) {
		echo "<p>conn failed:" . mysqli_connect_error() . " </p>\n";
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


	function contentAsArray($pagepath) 
	{ 
		$pageArray = [];
		foreach (glob($pagepath . '*.php') as $filename)
		{
			if( ($filename != ($pagepath . 'login.php')) && 
				($filename != ($pagepath . 'logout.php')) && 
				($filename != ($pagepath . 'account.php')) &&
				($filename != ($pagepath . 'register.php')) 
			)  
			{
				array_push($pageArray, $filename);   
			}
		}
		if (!(isset($_SESSION['username']))) {
			//echo $pagepath;	
			array_push( $pageArray, $pagepath . 'register.php' );
			array_push( $pageArray, $pagepath . 'login.php' );
		} else {
			array_push( $pageArray, $pagepath . 'account.php' );
			array_push( $pageArray, $pagepath . 'logout.php' );
		}
		return $pageArray;
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
		} else {
			echo $_SESSION['themeType'] = 'light';
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
		
		echo '<li id="navlogo"><a href="../index.php"><img id="logo" src="' . $logosrc . '" alt="Visit Matsumoto Logo" height="30"/></a></li>';
		
	}
//		<form id="login" method="post" action="/content/php/dologin.php"> 

	function navbarloginform () {
		$login = '
		<form id="login" method="post" action="/content/php/dologin.php"> 
		Username:    
		<input type= "text" name="username" size="8" /><br />
		Password:
		<input type= "password" name="password" size="8" /> </li><li id="navsub">
		<input type="submit" id="loginbutton" class="navbutton"value="Login" /> 
		</form>
		';
		echo $login;
	}


	function navbarlogoutform ($value) {
		$logout = <<<LOGOUT
		<form id="logout" method="post" action="/content/php/dologout.php"> 
		<input type="submit" class="navbutton" id="logoutbutton" value="$value" /> 
		</form>
		LOGOUT;

		echo $logout;
	}
	

	/*	function navbarlogoutform () {
		$logout = '
		<form id="logout" method="post" action="/content/php/dologout.php"> 
		<input type="submit" value="Logout" /> 
		</form>
		';
		echo $logout;
	}
	*/

	//<form id="login" method="post" action="./php/dologin.php"> 
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
		<form id="logout" method="post" action="/content/php/dologout.php"> 
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



	function fallbacktheme() {//Fall back Dark mode / light form mode button
	//$themeType = getTT();
	echo '<li>';
	$changeTheme = ($themeType == 'light') ? 'dark' : 'light';
	$ctstring = '<a id="ctheme" href="?theme=' . $changeTheme;
	if ($themeType == 'light') {
		$ctstring .= '">Dark Mode';
	} else {
		$ctstring .= '">Light Mode';
	}
	echo $ctstring . '</a></li>';

	echo '<li><form id="theme" method="post" action="./index.php"><input type="submit" name="theme" value="dark"/> </form></li>';
	}


	function br() {
		echo "<br />";

	}

	function listacts(){
		
	}

?>