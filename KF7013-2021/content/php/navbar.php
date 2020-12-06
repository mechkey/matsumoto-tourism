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
	
	

	/*
	$index = "index.php";
	$sightseeing = "./content/sightseeing.php";
	$name1 = str_replace('.php', '', $index);
	$name1 = str_replace('./content/', '', $name1);
	echo $name1;
	$name2 = str_replace('.php', '', $sightseeing);
	$name2 = str_replace('./content/', '', $name2);
	echo $name2;
	$dirlevel = str_replace('./', '', $path);
	$dirlevel = str_replace('', '', $dirlevel);
	*/

	if (preg_match('/content/', $path)) {
		$pageArray = [
			0 => "./activities.php",
			1 => "./events.php",
			2 => "./sightseeing.php",
			3 => "./credits.php",
			4 => "./account.php",
		];
		if (!(isset($_SESSION['username']))) {
			$loginpage = "./login.php";
			array_splice( $pageArray, 5, 0, $loginpage );
		}
	}

	else {
		$pageArray = [
			0 => "./content/activities.php",
			1 => "./content/events.php",
			2 => "./content/sightseeing.php",
			3 => "./content/credits.php",
			4 => "./content/account.php",
		];
		if (!(isset($_SESSION['username']))) {
			$loginpage = "./content/login.php";
			array_splice( $pageArray, 5, 0, $loginpage );

		}
	}
	echo '<ul>';
	
	//Logic to choose logo or brighter logo for dark mode - from logo.php
	showLogo($_SERVER['REQUEST_URI']);

	$listart = '<li id="navlink"><a href="';
	$limid = '">';
	$limidcur = '" id="current">';
	$liend = '</a></li>';

	//Create the links from the array.
	foreach ($pageArray as $value) {
		$name = str_replace('.php', '', $value);
		$name = str_replace('./content/', '', $name);
		$name = str_replace('./', '', $name);
		$name = str_replace('.', '', $name);
		$name = ucfirst($name);
		//echo " Value is " . $value;
		if ($value == $path) {
			echo $listart . $value . $limidcur . $name . $liend;
		} else {
			echo $listart . $value . $limid . $name . $liend;
		}

	}

	/*
	//Fall back Dark mode / light form mode button
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
	*/
	


	//Light mode/dark mode button
	echo '<li>';
	
	if (isset($_SESSION['themeType'])) {
		if  ($_SESSION['themeType'] == 'dark') {
			//$_SESSION['themeType'] = $themeType;
			echo '<li><form id="theme" method="post" action="' . $_SERVER['PHP_SELF'] . '"><button type="submit" name="theme" value="light"/>Light Mode</button></form></li>';
		//} else if ((getTT() == 'light') || is_null($_SESSION['themeType'])) {
		//} else if (($_SESSION['themeType'] == 'light') ) {
		} else if (($_SESSION['themeType'] == 'light') ) {
			//$_SESSION['themeType'] = $themeType;
			echo '<li><form id="theme" method="post" action="' . $_SERVER['PHP_SELF'] . '"><button type="submit" name="theme" value="dark"/>Dark Mode</button></form></li>';
		}
	}
	
	echo '</li>';

	////Logic to determine whether the login form's action should include the content folder.


	//Show nav bar login
	echo '<li>';
	//echo 'login should be here ';
	if (isset($_SESSION['username'])) {
		//echo 'arraykeyset';
		echo 'Username: ' . $_SESSION['username'];
		echo '</li><li>';
		//
		navbarlogoutform($_SERVER['REQUEST_URI']);
		//
	} else {
			//
			navbarloginform($_SERVER['REQUEST_URI']);
			//
		}
	echo '</li>';



	//echo '<li> pathcopy is ' . $pathcopy . '</li>';
	echo "</ul>";
	
	//return $navContent;

}
?>