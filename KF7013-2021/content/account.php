<?php

	session_start();
	
	if (isset($_SESSION['username'])) {
		//echo 'Session set';
	} else {
		header("Location: ../index.php");
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css">
	<?php 
	include './php/head.php';
	include './php/navbar.php';
	echo makeHead("Matsumoto Tourism - Home");
	?>
</head>
<body class="<?php echo $themeType; ?>">
	<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
		<nav id="topnav">
			<?php 
			makeNavBar($themeType); 
			?>
		</nav>
		<main id="content"> <!-- Beginning of page content -->
			<H1>My Account page</h1>
				<p>Do you wish to logout?</p>
			<?php

			logoutform();

			echo 'Username: ' . $_SESSION['username'];
			?>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

