<?php


function makeNavBar () {

	//Main Nav bar gen

	$path = $_SERVER['REQUEST_URI'];
	$path = str_replace('/index', 'index', $path);
	//echo "path is " . $path . "<br />";
	//$fPage = '<li><a href="' . $path . '" id="current">1</a></li>';
	
	$listart = '<li><a href="';
	$limid = '" >';
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
		];
	}

	else {
		$pageArray = [
			0 => "index.php",
			1 => "./content/activities.php",
			2 => "./content/events.php",
			3 => "./content/sightseeing.php",
			3 => "./content/attribution.php",
		];
	}
	echo "<nav>";
	echo '<ul id="nav-ul">';
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
	echo "</ul>";
	echo "<br />";

	//for some reason I cannot get this to work in navbar.php... but it works in html...
	
	//$changeTheme = ($themeType == 'light') ? 'dark' : 'light';
	//echo '<a href="?theme=' . $changeTheme . '">Change Theme</a>';
	
	//return $navContent;
}

?>