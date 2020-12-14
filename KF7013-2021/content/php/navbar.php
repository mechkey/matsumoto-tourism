<?php
//include 'path.php';

include 'main.php';
//Logo includes main.php

//function makeNavBar ($themeType) {
function makeNavBar () {

	//Navigation bar generation

	$path = getpath();

	$path = str_replace('/index', 'index', $path);
	//echo "path is " . $path . "<br />";
	//$fPage = '<li><a href="' . $path . '" id="current">1</a></li>';
	
	
	echo '<ul>';
	
	//Logic to choose logo or brighter logo for dark mode - from logo.php
	showLogo($_SERVER['REQUEST_URI']);

	$listart = '<li class="navlink"><a href="';
	$limid = '">';
	$limidcur = '" id="current">';
	$liend = '</a></li>';

	
	//Get the contents of /content and put them in an array
	if ($path == 'index.php') {
		$inpvar = 'content/';
	} else {
		$inpvar = '';
	}
	$pageArray = contentAsArray($inpvar);

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
			echo '<form id="theme" method="post" action="' . $_SERVER['PHP_SELF'] . '"><button type="submit" name="theme" class="navbutton" value="light"/>Light Mode</button></form></li>';
		//} else if ((getTT() == 'light') || is_null($_SESSION['themeType'])) {
		//} else if (($_SESSION['themeType'] == 'light') ) {
		} else if (($_SESSION['themeType'] == 'light') ) {
			//$_SESSION['themeType'] = $themeType;
			echo '<form id="theme" method="post" action="' . $_SERVER['PHP_SELF'] . '"><button type="submit" name="theme" class="navbutton" value="dark"/>Dark Mode</button></form></li>';
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
	echo '</li><li class="navlink">';


	echo searchbar();


	//echo '<li> pathcopy is ' . $pathcopy . '</li>';
	echo "</li></ul>";
	
	//return $navContent;

}
?>