<?php
	session_start();
	include './php/head.php';
	include './php/navbar.php';
	logincheck();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css"/>
	<?php 
		$filename = ucfirst(basename(__FILE__, ".php")) . " - Matsumoto Tourism";
		makeHead($filename);
	?>
</head>
<body class="<?php classID() ?>">
	<nav id="topnav">
		<?php 
			makeNavBar(); 
		?>
	</nav>
	<main id="content"> <!-- Beginning of page content -->
		<?php 
			echo '<p>My Account page</p>';
			showDetails();
			echo '<p>Booked Activities: </p>';
			booked_act();
			logoutform("Logout");
		?>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>