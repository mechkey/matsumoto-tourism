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
<body class="<?php classID() ?>">
	<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
		<nav id="topnav">
			<?php 
			makeNavBar(); 
			?>
		</nav>
		
		<main id="content"> <!-- Beginning of page content -->
			<p> Some main stuff 

				<li><form id="theme" method="post" action="./index.php"><input type="submit" name="theme" value="dark"/> </form></li>

				<?php

				echo "<pre>"; 
				print_r($_SESSION); 
				echo "</pre>";

				br();
				echo '__File_ is: ' . __FILE__ ;
				br();
				echo 'SERVER-REQUEST_URI is ' . $_SERVER['REQUEST_URI'];
				br();
				echo 'get root is ' . getroot($_SERVER['REQUEST_URI']);

				br();

				echo 'login logout path stuff <br />';

				$pathcopy = getpath();
				$loginoutpath = '';

				if (preg_match('/content/', $pathcopy)) {
						$loginoutpath = './php/';
						echo ' loginoutpath is ' . $loginoutpath;
					} else {
						$loginoutpath = './content/php/';
						echo ' loginoutpath is ' . $loginoutpath;
					}

				echo '<br />end path';

				//$themevar = $_POST['theme'];
				//echo $themevar;

				$themestring = '<li><form id="theme" method="post" action="' . $_SERVER['PHP_SELF'] . '"><input type="submit" name="theme" value="';

				//echo $themestring;

						navbarlogoutform($_SERVER['REQUEST_URI']);

				//echo 'Username: ' . $_SESSION['username'];
				?>
		</p>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

