<?php
	session_start();
	include './content/php/navbar.php';
	include './content/php/head.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="./assets/stylesheets/main.css"/>
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
		<p> Some main stuff - this is the index page

			<?php

			if ($debug) {
				echo 'SERVER-REQUEST_URI is ' . $_SERVER['REQUEST_URI'];
				br();
				echo 'path is ' . getpath();
				br();	
			}
		
				echo "<pre>"; 
				print_r($_SESSION); 
				echo "</pre>";
			
			//$themevar = $_POST['theme'];
			//echo $themevar;
			$themestring = '<li><form id="theme" method="post" action=""><input type="submit" name="theme" value="';
			//echo $themestring;
			//navbarlogoutform($_SERVER['REQUEST_URI']);
			//echo 'Username: ' . $_SESSION['username'];
			//echo'<li><form id="theme" method="post" action="./index.php"><input type="submit" name="theme" value="dark"/> </form></li>';
			?>
	</p>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>

