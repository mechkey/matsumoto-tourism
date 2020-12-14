<?php
	include 'main.php';
	phpstyle();

	$search = htmlspecialchars($_REQUEST['search']);
	$search = '%' . $search . '%';
	echo 'Search string: ' . $search;

	echo '<table class="act_table"><tr><th class="act_name">Activity Name</th><th class="act_desc">Description</th><th class="price">Price</th><th class="loc">Location</th></tr>';


	$mysqli = new mysqli('localhost', 'root', 'root', 'travel');

		$sql = "SELECT activity_name, description, price, location FROM `activities` WHERE `activity_name` LIKE ?";
		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("s", $search);
			$stmt->execute();
			$stmt->bind_result($act_name, $desc, $price, $loc);
			echo $desc;
			
			while ($stmt->fetch()) {
				printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="tinycol">%s</td><td class="shortcol">%s</td><td class="shortcol"	>Submit</td></tr>', $act_name, $desc, $price, $loc);
			}
			$stmt->close();
		}
	$mysqli->close();


	echo '</table>';



	// ?%


	phpstyleend();
?>