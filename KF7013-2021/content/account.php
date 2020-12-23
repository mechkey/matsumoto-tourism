<?php
	session_start();
	include './php/head.php';
	logincheck();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css">
	<?php 
	include './php/head.php';
	include './php/navbar.php';
	echo makeHead("Matsumoto Tourism - My Account");
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
			<H1>My Account page</h1>
				<?php 
						showDetails();
				?>
				<h2>Booked Activities: </h2>
				<table class="act_table"><tr><th class="act_name">Your Booked Activities</th><th class="act_id">Activity ID</th><th class="act_desc">Activity Date</th><th class="price">Number of Tickets</th><th>Details</th></tr>
				<?php 
				// Trying OO php . . .
				$mysqli = new mysqli('localhost', 'root', 'root', 'travel');

				//$sql = "SELECT a.activity_name, b.activityID, b.date_of_activity, b.number_of_tickets FROM `booked_activities` b LEFT OUTER JOIN activities a ON a.activityID = b.activityID";
				$sql = "SELECT a.activity_name, b.activityID, b.date_of_activity, b.number_of_tickets FROM `booked_activities` b LEFT OUTER JOIN activities a ON a.activityID = b.activityID LEFT OUTER JOIN customers c ON b.customerID = c.customerID WHERE c.username=?";
				if ($stmt = $mysqli->prepare($sql)) {
					$stmt->bind_param('s', $_SESSION['username']);
					$stmt->execute();
					$stmt->bind_result($act_name, $act_id, $date, $num_tix);
					while ($stmt->fetch()) {
						printf ('<tr><td class="act_name">%s</td><td class="act_id">%d</td><td class="act_date">%s</td><td class="price">%s</td><td><a href="activities.php">View Details</tr>', $act_name, $act_id, $date, $num_tix);
					}
					$stmt->close();
				}
				$mysqli->close();

				navbarlogoutform("Logout");
				?>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

