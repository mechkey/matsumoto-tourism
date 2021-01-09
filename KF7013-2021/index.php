<?php
	session_start();
	include './content/php/navbar.php';
	include './content/php/layout.php';
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
		makenav_bar(); 
		?>
	</nav>
	
	<main id="content"> <!-- Beginning of page content -->
		<h1>Welcome to Matsumoto's Tourism Website!</h1>	
		<?php
		
				
		echo '</select><input type="submit" value="Submit" class="nav_button">'; ?>
			<div class="flex_box">
				<?php
				
				// This was an attempt to get the values of activities as an array for dynamically creating 'cards' to advertise the activities available.
				$act_array = act_info_array();
				foreach ($act_array as $value) {
					extract($value);
					$img_alt = alt($activityID);
					echo '<div class="card"><img class="card_img" src="./assets/images/'.$activityID.'.jpg" alt="'.$img_alt.'"></img>';
					echo '<div class="copy"><h1>'.$activity_name.'</h1><p>'.$description.'</p></div></div>';
				}
				
				
				//$themevar = $_POST['theme'];
				//echo $themevar;
				$themestring = '<li><form id="theme" method="post" action=""><input type="submit" name="theme" value="';
				//echo $themestring;
				//nav_barlogout_form($_SERVER['REQUEST_URI']);
				//echo 'Username: ' . $_SESSION['username'];
				//echo'<li><form id="theme" method="post" action="./index.php"><input type="submit" name="theme" value="dark"/> </form></li>';
				?>
				<aside>
					<p>Please <a href="/KF7013-2021/content/register.php">register</a> to book these activities!</p>
				</aside>
			</div>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>

