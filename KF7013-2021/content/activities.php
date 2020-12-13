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
			<table class="act_table"><tr><th class="act_name">Activity Name</th><th class="act_desc">Description</th><th class="price">Price</th><th class="loc">Location</th></tr>
				<?php 
				// Trying OO php . . .
				$mysqli = new mysqli('localhost', 'root', 'root', 'travel');

				$sql = "SELECT activity_name, description, price, location FROM `activities`";
				if ($stmt = $mysqli->prepare($sql)) {
					$stmt->execute();
					$stmt->bind_result($act_name, $desc, $price, $loc);
					

					while ($stmt->fetch()) {
						printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="tinycol">%s</td><td class="shortcol">%s</td><td class="shortcol"	>Submit</td></tr>', $act_name, $desc, $price, $loc);
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
