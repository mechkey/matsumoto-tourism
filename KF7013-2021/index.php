<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="./assets/stylesheets/main.css">
	<?php 
	foreach (glob("./content/php/*.php") as $filename)
	{
		include $filename;
	} 
	echo makeHead("Matsumoto Tourism - Home");

	?>
</head>
<body class="<?php echo $themeType; ?>">
	<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
		<?php 
		echo makeNavBar(); 

		$changeTheme = ($themeType == 'light') ? 'dark' : 'light';
		echo '<a href="?theme=' . $changeTheme . '">Change Theme</a>';
		
		echo '</nav>';
		?>
		<main id="content"> <!-- Beginning of page content -->
			<p> Some main stuff 
			
		</p>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

