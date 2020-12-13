<?php

function makeHead ($pageTitle) {
	$headContent = <<<HEAD
		<title>$pageTitle</title>
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Keywords" content="travel, fun, hotels, flights, trip, travelling, photographer, beach, style, sunset, holiday, lifestyle, life, traveltheworld, beauty, mountains, sea, tourism, traveler, traveller, architecture">
	HEAD;
	return $headContent;
}

function makeHeadToMain ($pageTitle) {
	/*
	<?php
		session_start();
	?>

	<?php

		session_start();
		
		if (isset($_SESSION['username'])) {
			//echo 'Session set';
		} else {
			header("Location: ../index.php");
		}	
	?>
	*/
	/*
	$fullmake = <<<MAKE
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<link rel="stylesheet" href="../assets/stylesheets/main.css">
		<?php 
		include './php/head.php';
		include './php/navbar.php';
		echo makeHead($pageTitle);
		?>
	</head>
	<body class="<?php classID() ?>">
		<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
			<nav id="topnav">
				<?php 
				makeNavBar(); 
				?>
			</nav>
			MAKE;

			echo $fullmake;
			*/
}

?>