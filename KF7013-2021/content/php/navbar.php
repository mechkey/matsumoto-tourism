<?php

include 'main.php';
function makeNavBar ($themeType) {

	//Navigation bar generation

	$path = $_SERVER['REQUEST_URI'];
	$fpath = $path;

	$path = str_replace('/index', 'index', $path);
	//echo "path is " . $path . "<br />";
	//$fPage = '<li><a href="' . $path . '" id="current">1</a></li>';
	
	$listart = '<li><a href="';
	$limid = '">';
	$limidcur = '" id="current">';
	$liend = '</a></li>';

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
			3 => "./attribution.php",
			4 => "./account.php",
		];
	}

	else {
		$pageArray = [
			0 => "./content/activities.php",
			1 => "./content/events.php",
			2 => "./content/sightseeing.php",
			3 => "./content/attribution.php",
			4 => "./content/account.php",


		];
	}
	echo '<ul>';
	
	//Logic to choose logo or brighter logo for dark mode.
	$logosrc = ''; 	
	if ($_SESSION['themeType'] == 'dark') { 		
		$logosrc = './assets/images/logogray.png'; 	
	} else { 
		$logosrc = './assets/images/logo.png'; 	
	}

	//The website logo.
	//If the page is located in the content folder, append another . to the logo src to make ../
	if (preg_match('/content/', $path) ) {
		echo '<li><a href="../index.php"><img id="logo" src=".' . $logosrc . '" alt="Visit Matsumoto Logo" height="30"/></a></li>';
		}
	else {
		echo '<li><a href="../index.php"><img id="logo" src="' . $logosrc . '" alt="Visit Matsumoto Logo" height="30"/></a></li>';
		}

	//Create the links from the array.
	foreach ($pageArray as $value) {
		$name = str_replace('.php', '', $value);
		$name = str_replace('./content/', '', $name);
		$name = str_replace('./', '', $name);
		$name = str_replace('.', '', $name);
		$name = ucfirst($name);
		//echo " vlaue is " . $value;
		if ($value == $path) {
			echo $listart . $value . $limidcur . $name . $liend;
		} else {
			echo $listart . $value . $limid . $name . $liend;
		}

	}




	//Dark mode / light mode button
	/*
	echo '<li>';
	$changeTheme = ($themeType == 'light') ? 'dark' : 'light';
	$ctstring = '<a id="ctheme" href="?theme=' . $changeTheme;
	if ($themeType == 'light') {
		$ctstring .= '">Dark Mode';
	} else {
		$ctstring .= '">Light Mode';
	}
	echo $ctstring . '</a></li>';
	*/


	//$changeTheme = ($themeType == 'light') ? 'dark' : 'light';

	if  ($_SESSION['themeType'] =='dark') {
		echo '<li><form id="theme" method="post" action="' . $_SERVER['PHP_SELF'] . '"><button type="submit" name="theme" value="light"/>Light Mode</button></form></li>';
	} else if (($_SESSION['themeType'] == 'light') || ($themeType == '')) {
		echo '<li><form id="theme" method="post" action="' . $_SERVER['PHP_SELF'] . '"><button type="submit" name="theme" value="dark"/>Dark Mode</button></form></li>';
	}
	

	$mpath = '';

	if (preg_match('/content/', $fpath)) {
			$mpath = './';
		} else {
			$mpath = './content/';
		}

	//Logic to determine whether the login form's action should include the content folder.
	if(isset($_SESSION['username'])) {
		echo 'Username: ' . $_SESSION['username'];
		echo '</li><li>';
		navbarlogoutform($mpath);
		//echo 'session set';
		//navbarloginform($mpath);
	} else {
		//echo 'session not set';
		navbarloginform($mpath);


		//logoutform($fpath);
	}



	//echo '<li> fpath is ' . $fpath . '</li>';
	echo "</ul>";
	
	//return $navContent;
	}

?>