<?php
	session_start();
	include './php/dologin.php';
	include './php/navbar.php';
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
			echo '<H1>My Account page</h1>';
			viewDetails();
			//view details of a single booked activity
			if (isset($_GET['select_id'])) {
				booked_act_details(true);
			}
			//modify a booking
			if (isset($_GET['a_id'])) {
				mod_book(true);
			} 
			//cancel a booking
			if (isset($_GET['delete_id'])) {
				echo '<h2 class="tworem">Are you sure you wish to delete the following booking?</h2>';
				booked_act_details(true);
				echo '<form id="confirmed" method="post" action="./php/dodelete.php?delete_id='.$_GET['delete_id'].'"><button type="submit" class="tworem">Confirm</button></form>';
			}
			booked_act();
			
		?>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>