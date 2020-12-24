<?php
	session_start();
	include './php/head.php';
	include './php/navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css">
	<?php 
	echo makeHead("Matsumoto Tourism - Logout");
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
			<div class="logout">

				<p>Are you sure you wish to logout?</p>
				<?php
				logoutform();
				?>
			</div>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>
