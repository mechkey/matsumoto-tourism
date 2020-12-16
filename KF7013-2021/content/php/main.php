<?php
	//Connect to database

	$debug = false;
	$dev = true;

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

	//Init dark mode vars

	$themeType = '';
	//$_SESSION['themeType'] = '';
	$changeTheme = '';
	if (((isset($_REQUEST['theme'])) && ($_REQUEST['theme'] == 'dark'))) {
		$_SESSION['themeType'] = 'dark';
	} else if ((isset($_REQUEST['theme'])) && ($_REQUEST['theme'] == 'light')) {
		$_SESSION['themeType'] = 'light';
	} 

	function br() {
		echo "<br />";
	}

	function classID() {
		if (isset($_SESSION['themeType'])) {
			echo $_SESSION['themeType'];
		} else {
			echo $_SESSION['themeType'] = 'light';
		}
	}

	function contentAsArray($rel) { 
		global $debug;
		$tmpPageArray = [];
		foreach (glob($rel . '*.php') as $filename)
		{
			if ($debug) { echo $filename; }
			//if it isn't a page to do with login/out
			if( 
				($filename != ($rel . 'login.php')) && 
				($filename != ($rel . 'logout.php')) && 
				($filename != ($rel . 'account.php')) &&
				($filename != ($rel . 'register.php')) 
				)  
			{
				//then push it to the array
				array_push($tmpPageArray, $filename);   
			}
		}
		//if it is a login/registration page AND the user is not logged in, add it to the end of the array
		if (!(isset($_SESSION['username']))) { // if not loggged in
			//echo $curpagepath;	
			array_push( $tmpPageArray, $rel . 'register.php' );
			array_push( $tmpPageArray, $rel . 'login.php' );
		//else if it a must be logged in page, only show it if logged in, and add it to the end of the array
		} else { // if logged in
			array_push( $tmpPageArray, $rel . 'account.php' );
			array_push( $tmpPageArray, $rel . 'logout.php' );
		}
		return $tmpPageArray;
	} 

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
		<form id="logout" method="post" action="/KF7013-2021/content/php/dologout.php"> 
		<input type="submit" value="Logout" /> 
		</form>
		';
		echo $logout;
	}


	function listacts(){
		//todo	
	}


//		<form id="login" method="post" action="/KF7013-2021/content/php/dologin.php"> 
	function navbarloginform () {
		$login = '
		<form id="login" method="post" action="/KF7013-2021/content/php/dologin.php"> 
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
		<form id="logout" method="post" action="/KF7013-2021/content/php/dologout.php"> 
		<input type="submit" class="navbutton" id="logoutbutton" value="$value" /> 
		</form>
		LOGOUT;

		echo $logout;
	}
	

	/*	function navbarlogoutform () {
		$logout = '
		<form id="logout" method="post" action="/KF7013-2021/content/php/dologout.php"> 
		<input type="submit" value="Logout" /> 
		</form>
		';
		echo $logout;
	}
	*/

	function phpstyle() {
		
			echo '
			<style>
			body {
		  		background-color: #111;
			}
			html {
				color:gray;
			}
			</style>
			<p>';
		
	}

	function phpstyleend() {
		echo '<p>';
	}

	function searchbar() {
		echo '<form id="search_form" method="post" action="/KF7013-2021/content/php/search.php"><input id="search" name="search" type="text" placeholder="Search..."><input type="submit" class="navbutton"></form>';
	}

	//The website logo light mode and dark mode selector.
	function showLogo ($path) {
		$logosrc = ''; 	
		if (isset($_SESSION['themeType']) && $_SESSION['themeType'] == 'dark') { 		
			$logosrc = '/KF7013-2021/assets/images/logogray.png'; 	
		} else { 
			$logosrc = '/KF7013-2021/assets/images/logo.png';
		}
		
		echo '<li id="navlogo"><a href="/KF7013-2021/index.php"><img id="logo" src="' . $logosrc . '" alt="Visit Matsumoto Logo" height="30"/></a></li>';
		
	}
	


?>