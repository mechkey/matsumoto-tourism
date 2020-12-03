<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="./assets/stylesheets/main.css">
	<?php 
	include './content/php/head.php';
	include './content/php/navbar.php';
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
			<p> Some main stuff 

			
			
				<li><form id="theme" method="post" action="./index.php"><input type="submit" name="theme" value="dark"/> </form></li>

				<?php


				$themestring = '<li><form id="theme" method="post" action="' . $_SERVER['PHP_SELF'] . '"><input type="submit" name="theme" value="';

				//echo $themestring;

				
				//echo 'Username: ' . $_SESSION['username'];
				?>
		</p>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

