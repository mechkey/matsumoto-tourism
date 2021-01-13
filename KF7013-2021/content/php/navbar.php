<?php
include_once 'main.php';

//Init dark mode vars
$themeType = '';
//$_SESSION['themeType'] = '';
$changeTheme = '';
if (((isset($_REQUEST['theme'])) && ($_REQUEST['theme'] == 'dark'))) {
	$_SESSION['themeType'] = 'dark';
} else if ((isset($_REQUEST['theme'])) && ($_REQUEST['theme'] == 'light')) {
	$_SESSION['themeType'] = 'light';
}

function makenav_bar () {

	//Navigation bar generation
	$debug = false;

	echo '<div id="displaytable"><ul>';
	
	//Logic to choose logo or brighter logo for dark mode - from logo.php
	showLogo($_SERVER['REQUEST_URI']);

	$path = getpath();
	if ($debug) {echo 'path is: ' . $path . '	';}

	$path = str_replace('/kf7013-2021/index', 'index', $path);
	if ($debug) {
		echo "path is now: " . $path . "<br />";
		$fPage = '<li><a href="' . $path . '" id="current">1</a></li>';
	}

	//set curpagepath so that glob works correctly
	if (($path == 'index.php') || ($path == '/kf7013-2021/')) {
		$curpagepath = 'content/';
	} else {
		$curpagepath = '';
	}
	if ($debug) {
		echo 'cur page path is: ' . $curpagepath;
	}


	$key = 2;
	$pageArray = contentAsArray($curpagepath);
	//Create the links from the array.
	foreach ($pageArray as $value) {
		$listart = '<li class="nav_link"><a href="';
		$limid = '" accesskey="'. $key . '" class="nav_a">';
		$limidcur = '"accesskey="'. $key . '" id="current">';
		$liend = '</a></li>';

		$name = $value;
		$name = str_replace('.php', '', $value);
		$name = str_replace('content/', '', $name);
		$name = ucfirst($name);
		//echo " value is " . $value;
		if ($name == "Account") {
			$name .= ": ".$_SESSION['username'];
		}
		if ($name == $path) {
			echo $listart . $value . $limidcur . $name . $liend;
		} else {
			echo $listart . $value . $limid . $name . $liend;
		}
		++$key;
	}

	//fallbacktheme();
	//Light mode/dark mode button
	echo '<li class="nav_link" id="li_nav_theme">';
	
	if (isset($_SESSION['themeType'])) {
		if  ($_SESSION['themeType'] == 'dark') {
			//$_SESSION['themeType'] = $themeType;
			echo '<form id="theme_form" method="post"><button type="submit" name="theme" class="nav_button" value="light"/>Light Mode</button></form>';

		} else if (($_SESSION['themeType'] == 'light') ) {
			//$_SESSION['themeType'] = $themeType;
			echo '<form id="theme_form" method="post"><button type="submit" name="theme" class="nav_button" value="dark">Dark Mode</button></form>';
		}
	}
	echo '</li>';
	//Show nav bar login
	//echo 'login should be here ';
	if (isset($_SESSION['username'])) {
		/*echo '<li id="nav_uname">';
		echo 'Account: ' . $_SESSION['username'] . </li>;*/
		echo '<li id="nav_logout">';
		logout_form("logout");
	} /* else {
			echo '<li id="nav_login">';
			login_form(true);
	}*/

	/*
	echo '<li class="nav_link">';
	echo searchbar();
	echo "</li>";
	*/
	echo"</ul></div>";
	//return $navContent;
}

// *** *** *** *** *** *** *** *** *** *** 
//Supporting functions in alphabetical order
// *** *** *** *** *** *** *** *** *** ***  ***  ***  ***  ***  


function contentAsArray($rel) { 
	global $debug;
	$tmpPageArray = [];
	foreach (glob($rel . '*.php') as $filename)
	{
		if ($debug) { echo $filename; }
		//if it isn't a page to do with login/out
		if( 
			($filename != ($rel . 'lost.php')) && 
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

	echo '<li><form id="theme" method="post" action="./index.php"><input type="submit" name="theme" value="dark"/></form></li>';
}

function getpath() {
	$path = $_SERVER['REQUEST_URI'];
	return $path;
}

function showLogo ($path) {
	$logosrc = ''; 	
	if (isset($_SESSION['themeType']) && $_SESSION['themeType'] == 'dark') { 		
		$logosrc = '/kf7013-2021/assets/images/logogray.png'; 	
	} else { 
		$logosrc = '/kf7013-2021/assets/images/logo.png';
	}
	
	echo '<li id="navlogo"><a href="/kf7013-2021/index.php" accesskey="1"><img id="logo" src="' . $logosrc . '" alt="visit Matsumoto Logo" height="30"/></a></li>';
}
?>