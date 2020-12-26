<?php
	session_start();
	include './php/head.php';
	include './php/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css"/>
	<?php 
	echo makeHead("Matsumoto Tourism - Login");
	?>
</head>
<body class="<?php classID() ?>">
	<nav id="topnav">
		<?php 
		makeNavBar(); 
		?>
	</nav>
	<main id="content"> <!-- Beginning of page content -->
		<div class="login">
			<?php
			loginform();
			?>
		</div>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		makeFooter();
	</footer>
</body>
</html>
