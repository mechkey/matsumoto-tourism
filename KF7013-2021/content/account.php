<?php
	session_start();
	include './php/nav_bar.php';
	include './php/layout.php';
	logincheck();
	doctype_etc();
?>

<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css"/>
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
		<?php 
			echo '<p>My Account page</p>';
			showDetails();
			echo '<p>Booked Activities: </p>';
			booked_act();
			logout_form("Logout");
		?>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>