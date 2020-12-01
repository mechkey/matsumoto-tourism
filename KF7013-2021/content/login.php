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
<body class="<?php echo $themeType; ?>">
	<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
		<nav id="topnav">
			<?php 
			makeNavBar($themeType); 
			?>
		</nav>
		<main id="content"> <!-- Beginning of page content -->
			<?php
				echo 'Please login: ';

				$form = <<<FORM
				<form id="login" method="post" action="dologin.php"> 
				Username:   
				<input type= "text" name="userName" /><br />
				Password:
				<input type= "password" name="password" /> 
				<input type="submit" value="Login" /> 
				</form>

				FORM;

				echo $form
			?>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>