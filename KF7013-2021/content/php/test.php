<?php
echo "The time is " . date("h:i:sa");

	if (true == true) {
		//echo 'true is true';
	}

function getpatht() {
	$path = $_SERVER['REQUEST_URI'];
	//$path = str_replace('^.*(?=(\/))', '', $path);
	//$path = str_replace('/kf7013-2021/', '', $path);
	//$path = str_replace('^.*(?=(\/))', '', $path);
	return $path;
}

echo getpatht();

echo '<br /><a href="../testaccount.html">Click123k</a><br />';

echo '<a href="test.php">Clickk for test.php 123 lil bit maain</a>';
echo '<a href="/kf7013-2021">Clickk for /kf bit maain</a>';
echo '<a href="/w19041690">Clickk for /w194 bit maain</a>';

echo '<div class="card"><img class="card_img" src="./assets/images/'.$activityID.'.jpg" alt="'.$img_alt.'">';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function alt($activityID) {
		$alt = "";
		if ($activityID == 1) {
			$alt = "Matsumoto Castle surrounded by a moat with a red bridge";
		} else if ($activityID == 2) {
			$alt = "A bridge across the Kamikochi Valley river, with snow-covered mountains in the background";
		} else if ($activityID == 3) {
			$alt = "Steam rising from a hot spring with a traditional Japanese wooden building in the background";
		} else if ($activityID == 4) {
			$alt = "The front door of the Matsumoto Museum of Art with trees nearby";
		} else if ($activityID == 5) {
			$alt = "The lush garden of Ikegami Hyakuchikutei";
		} else if ($activityID == 6) {
			$alt = "The exterior of the Ukiyo-e Museum";
		} else if ($activityID == 7) {
			$alt = "Four students being instructed on how to play Taiko drums";
		} else if ($activityID == 8) {
			$alt = "Exterior showing the three stories of Another Castle";
		} else if ($activityID == 9) {
			$alt = "Bamboo pipes bring the hot spring water into the hot springs at Shirahone Hot Springs";
		}
		return $alt;
	}
		

	function booked_act () {
		global $conn;
		echo '<table class="booked_act_table"><caption>Booked Activities:</caption><tr><th class="longcol">Booked Activities</th><th class="act_id">Activity ID</th><th class="longcol">Activity Date</th><th class="tinycol">Number of Tickets</th><th>Details</th><th>Modify</th><th>Cancel</th></tr>';
		// Trying OO php . . .

		//$sql = "SELECT a.activity_name, b.activityID, date_of_activity, b.number_of_tickets FROM `booked_activities` b LEFT OUTER JOIN activities a ON a.activityID = b.activityID";
		$sql = "SELECT `activity_name`, b.activityID, DATE(b.date_of_activity), b.number_of_tickets FROM `booked_activities` b LEFT OUTER JOIN `activities` a ON a.activityID = b.activityID LEFT OUTER JOIN `customers` c ON b.customerID = c.customerID WHERE c.username=? ORDER BY `date_of_activity`";
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, 's', $_SESSION['username']);
			mysqli_execute($stmt);
			mysqli_stmt_bind_result($stmt, $act_name, $act_id, $date, $num_tix);
			while (mysqli_stmt_fetch($stmt)) {
				$date = date('d-m-Y', strtotime($date));
				printf ('<tr><td class="longcol">%s</td><td class="tinycol">%d</td><td class="shortcol">%s</td><td class="tinycol">%s</td><td class="shortcol"><a href="account.php?select_id=%d">View Details</a></td><td class="shortcol"><a href="account.php?a_id=%d">Modify booking</a></td><td class="shortcol"><a href="account.php?delete_id=%d">Delete booking</a></td></tr>', $act_name, $act_id, $date, $num_tix, $act_id, $act_id, $act_id);
			}
			echo '</table>';
			
		}
		
	}


	function booked_act_details() {
		global $debug;
		global $conn;
		$select_id = $_GET['select_id'] ?? null;
		$select_id = htmlspecialchars($select_id);
		if ($select_id == null) {
			if ($debug) {
				echo 'select  null%%';
			}
			$select_id = $_GET['delete_id'] ?? null;
		}
		$table = <<< TABLE
		 	<table class="act_table"><caption> Selected Booking Details:</caption><tr>
				<th class="shortcol">Activity Name</th>
				<th class="longcol">Description</th>
				<th class="shortcol">Activity date</th>
				<th class="shortcol">Location</th>
				<th class="tinycol">Price per ticket</th>
				<th class="tinycol">Tickets</th>
				<th class="tinycol">Total</th>
				<th class="tinycol">Hide</th>
TABLE;

		echo $table;

		// Trying OO php . . .
		//
		
		$sql = "SELECT `activity_name`, `description`, DATE(date_of_activity), `location`, `price`, `number_of_tickets`, (number_of_tickets * price) AS `total` FROM `booked_activities` ba join `activities` a on a.activityID = ba.activityID join `customers` c on c.customerID = ba.customerID WHERE c.username = ? AND a.activityID = ?";	
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, "sd", $_SESSION['username'], $select_id);
			mysqli_execute($stmt);
			mysqli_stmt_bind_result($stmt, $act_name, $desc, $booked_date, $loc, $price, $num_tix, $total);
			while (mysqli_stmt_fetch($stmt)) {
				printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="shortcol">%s</td><td class="shortcol">%s</td><td class="tinycol">£%d</td><td class="tinycol">%d</td><td class="tinycol">£%d</td><td class="tinycol"><a href="account.php" class"no_purple">Hide</a></td>
						</tr>', $act_name, $desc, $booked_date, $loc, $price, $num_tix, $total);
			}
		}
		echo '</table>';
	}
	
function makeHead ($pageTitle) {
	$headContent = <<<HEAD
		<title>$pageTitle</title>
		<meta charset="utf-8" />
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Keywords" content="travel, fun, hotels, flights, trip, travelling, photographer, beach, style, sunset, holiday, lifestyle, life, traveltheworld, beauty, mountains, sea, tourism, traveler, traveller, architecture">
HEAD;
	
	echo $headContent;
}









?>