<?php
//include 'path.php';

include 'main.php';
//Logo includes main.php

//function makeNavBar ($themeType) {
function makeNavBar () {

	//Navigation bar generation

	$debug = false;

	echo '<ul>';
	
	//Logic to choose logo or brighter logo for dark mode - from logo.php
	showLogo($_SERVER['REQUEST_URI']);

	$path = getpath();
	if ($debug) {echo 'path is: ' . $path . '	';}

	$path = str_replace('/KF7013-2021/index', 'index', $path);
	if ($debug) {
		echo "path is now: " . $path . "<br />";
		$fPage = '<li><a href="' . $path . '" id="current">1</a></li>';
	}

	//set curpagepath so that glob works correctly
	if (($path == 'index.php') || ($path == '/KF7013-2021/')) {
		$curpagepath = 'content/';
	} else {
		$curpagepath = '';
	}
	if ($debug) {
		echo 'cur page path is: ' . $curpagepath;
	}
	
	$pageArray = contentAsArray($curpagepath);
	//$pageArray = contentAsArray();

	$listart = '<li class="navlink"><a href="';
	$limid = '">';
	$limidcur = '" id="current">';
	$liend = '</a></li>';

	//Create the links from the array.
	foreach ($pageArray as $value) {
		$name = $value;
		$name = str_replace('.php', '', $value);
		$name = str_replace('content/', '', $name);
		$name = ucfirst($name);
		//echo " Value is " . $value;
		if ($name == $path) {
			echo $listart . $value . $limidcur . $name . $liend;
		} else {
			echo $listart . $value . $limid . $name . $liend;
		}

	}

	//fallbacktheme();

	//Light mode/dark mode button
	echo '<li class="navlink">';
	
	if (isset($_SESSION['themeType'])) {
		if  ($_SESSION['themeType'] == 'dark') {
			//$_SESSION['themeType'] = $themeType;

			echo '<form id="theme" method="post" action=""><button type="submit" name="theme" class="navbutton" value="light"/>Light Mode</button></form></li>';
		//} else if ((getTT() == 'light') || is_null($_SESSION['themeType'])) {
		//} else if (($_SESSION['themeType'] == 'light') ) {

		} else if (($_SESSION['themeType'] == 'light') ) {
			//$_SESSION['themeType'] = $themeType;
			echo '<form id="theme" method="post" action=""><button type="submit" name="theme" class="navbutton" value="dark"/>Dark Mode</button></form></li>';
		}
	}
	
	echo '</li>';

	////Logic to determine whether the login form's action should include the content folder.


	//Show nav bar login
	//echo 'login should be here ';
	if (isset($_SESSION['username'])) {
		echo '<li id="navuname">';
		echo 'Username: ' . $_SESSION['username'];
		echo '</li><li id="navlogout">';
		navbarlogoutform("Logout");
		
	} else {
			echo '<li id="navlogin">';
			navbarloginform();
	}

	
	echo '</li>';
	echo '<li class="navlink">';
	echo searchbar();
	

	//echo '<li> pathcopy is ' . $pathcopy . '</li>';

	echo "</li></ul>";
	
	//return $navContent;

}
?>