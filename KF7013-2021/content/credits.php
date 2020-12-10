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

			br();
				echo '__File_ is: ' . __FILE__ ;
				br();
				echo 'SERVER-REQUEST_URI is ' . $_SERVER['REQUEST_URI'];
				br();
				echo 'get root is ' . getroot($_SERVER['REQUEST_URI']);

				br();

			echo 'path stuff';

				$pathcopy = getpath();
				$loginoutpath = '';

				if (preg_match('/content/', $pathcopy)) {
						$loginoutpath = './';
						echo $loginoutpath;
					} else {
						$loginoutpath = './content/';
						echo $loginoutpath;
					}

				echo 'end path';

				?>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

