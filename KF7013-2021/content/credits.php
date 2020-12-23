<?php
	session_start();
	include './php/head.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css">
	<?php 
	include './php/navbar.php';
	echo makeHead("Matsumoto Tourism - Credits");
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
			<p>castle1.jpg https://www.japan-guide.com/e/e6050.html</p>
			<?php 
			
			?>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

