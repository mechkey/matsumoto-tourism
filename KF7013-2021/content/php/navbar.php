<?php

include 'main.php';

function makeNavBar ($themeType) {


	//Main Nav bar gen

	$path = $_SERVER['REQUEST_URI'];
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
			0 => "../index.php",
			1 => "./activities.php",
			2 => "./events.php",
			3 => "./sightseeing.php",
			4 => "./attribution.php",
			5 => "./login.php",
		];
	}

	else {
		$pageArray = [
			0 => "index.php",
			1 => "./content/activities.php",
			2 => "./content/events.php",
			3 => "./content/sightseeing.php",
			4 => "./content/attribution.php",
			5 => "./content/login.php",

		];
	}
	echo '<ul>';

	$logosrc = '';
	if ($themeType == 'dark') {
		$logosrc = '../assets/images/logogray.png';
	} else {
		$logosrc = '../assets/images/logo.png';
	}

	//If the page is locat
	if (preg_match('/content/', $path) ) {
		echo '<li><img id="logo" src="' . $logosrc . '" alt="Visit Matsumoto Logo" height="30"/> </li>';
		}
	else {
		echo '<li><img id="logo" src="' . $logosrc . '"" alt="Visit Matsumoto Logo" height="30" /></li>';
		}


	foreach ($pageArray as $value) {
		$name = str_replace('.php', '', $value);
		$name = str_replace('./content/', '', $name);
		$name = str_replace('./', '', $name);
		$name = str_replace('.', '', $name);
		$name = ucfirst($name);
		//echo "vlaue is " . $value;
		if ($value == $path) {
			echo $listart . $value . $limidcur . $name . $liend;
		} else {
			echo $listart . $value . $limid . $name . $liend;
		}

	}

	echo '<li>';
	$changeTheme = ($themeType == 'light') ? 'dark' : 'light';
	if ($themeType == 'light') {
		echo '<a id="ctheme" href="?theme=' . $changeTheme . '">Dark Mode</a></li>';
	} else {
		echo '<a id="ctheme" href="?theme=' . $changeTheme . '">Light Mode</a></li>';
	}

	

	echo "</ul>";
	
	//return $navContent;
}

?>