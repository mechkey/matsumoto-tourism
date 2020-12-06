
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
			<div class="login">
				
		<?php
		echo 'SERVER-REQUEST_URI is ' . $_SERVER['REQUEST_URI'];
		br();
		echo 'path is ' . getpath();	
		br();

		$pageArray = contentAsArray('');
		echo $pageArray;

		?>
			
			</div>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

