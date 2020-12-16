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
	echo makeHead("Matsumoto Tourism - Activities");
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
			<br />
			<table class="act_table"><tr><th class="act_name">Activity Name</th><th class="act_desc">Description</th><th class="price">Price</th><th class="loc">Location</th><th class="num_tix"><label for="num_tix">Tickets required:</label></th><th class="th_date"><label for="date">Date:</label></th><th class="book">Book</th></tr>
				<?php 
				// Trying OO php . . .
				$mysqli = new mysqli('localhost', 'root', 'root', 'travel');

				$sql = "SELECT activity_name, description, price, location, activityID FROM `activities`";
				if ($stmt = $mysqli->prepare($sql)) {
					$stmt->execute();
					$stmt->bind_result($act_name, $desc, $price, $loc, $act_id);

					echo $act_id;
					while ($stmt->fetch()) {
						printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="tinycol">%s</td><td class="shortcol">%s</td><td><form action="./php/book.php" method="post">
								<select name="num_tix" required>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select> 
								</td>

								<td><input type="date" id="date" name="date" required></td>

								<td><button type="submit" name="book" value="%s">Book</button></form></td></tr>', $act_name, $desc, $price, $loc, $act_id);
					}
					$stmt->close();
				}
				$mysqli->close();
				?>
				</table>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>
