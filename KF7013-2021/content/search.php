<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css">
	<?php
	include './php/head.php';
	include './php/navbar.php';
	echo makeHead("Matsumoto Tourism - Search");
	?>
</head>
<body class="<?php classID() ?>">
	<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
		<nav id="topnav">
			<?php 
			makeNavBar(); 
			?>
		</nav>
		<main id="content"> <!-- Beginning of page content -->
<?php
	//phpstyle();
	//$query_age = (isset($_GET['query_age']) ? $_GET['query_age'] : null);
	$search = (isset($_REQUEST['search']) ? $_REQUEST['search'] : null);
	$search = htmlspecialchars($search);
	//$floatsearch = floatval($search);
	$search = '%' . $search . '%';	
	//if ($debug) { echo 'Search string: ' . $search; }

	//make the table and table header
	echo '<table class="act_table"><tr><th class="act_name">Activity Name</th><th class="act_desc">Description</th><th class="price">Price</th><th class="loc">Location</th></tr>';


	$mysqli = new mysqli('localhost', 'root', 'root', 'travel');

		$sql = "SELECT `activity_name`, `description`, `price`, `location` FROM `activities` WHERE `activity_name` LIKE ? OR `description` LIKE ? OR `location` LIKE ?";
		//$sql = "SELECT `activity_name`, `description`, `price`, `location` FROM `activities` WHERE `activity_name` LIKE ? OR `description` LIKE ? OR `location` LIKE ? OR `price` LIKE ?";

		//$sql = "SELECT activity_name, description, price, location FROM `activities` WHERE `activity_name` LIKE ?";
		if ($stmt = $mysqli->prepare($sql)) {
			//$stmt->bind_param("s", $search);
			$stmt->bind_param("sss", $search, $search, $search);
			$stmt->execute();
			$stmt->bind_result($act_name, $desc, $price, $loc);
			//echo $desc;

			//echo 'search is: ' . $search . 'and floatsearch is: ' . $floatsearch;
			
			while ($stmt->fetch()) {
				printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="tinycol">%s</td><td class="shortcol">%s</td><td class="shortcol"	>Submit</td></tr>', $act_name, $desc, $price, $loc);
			}
			$stmt->close();
		}
	$mysqli->close();

	//end the table
	echo '</table>';

	//phpstyleend();
?>