<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="./assets/stylesheets/main.css">
	<?php include './php/head.php'; 
	echo makeHead("Matsumoto Tourism - Home");
	?>
</head>
<body>
	<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
		<?php 
		include './php/navbar.php'; 
		echo makeNavBar();
		?>
		<main id="content"> <!-- Beginning of page content -->
			<p> Some main stuff </p>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>
