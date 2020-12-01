<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css">
	<?php 
	foreach (glob("./php/*.php") as $filename)
	{
		include $filename;
	} 
	echo makeHead("Matsumoto Tourism - Home");

	?>
</head>
<body class="<?php echo $themeType; ?>">
	<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
		<nav id="topnav">
			<?php 
			echo makeNavBar(); 
			echo '<li>';
			//$changeTheme = ($themeType == 'light') ? 'dark' : 'light';
			//echo '<a id="ctheme" href="?theme=' . $changeTheme . '">Change Theme</a></li></ul>';
			//echo themeButton();
			?>
		</nav>
		
		<main id="content"> <!-- Beginning of page content -->
			<?php
				echo 'Please login: ';

				$form = <<<FORM
				<form id= method="post" action = "dologin.php"> 
				Name:   
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