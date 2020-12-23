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
	echo makeHead("Matsumoto Tourism - Search");
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
		<?php
		

		if (isset($_REQUEST['search'])) {
			echo "<h1>Search results for '{$_REQUEST['search']}' : </h1>";
		} else {
			echo '<h1>Showing all activities. Please enter a search term: </h1>';
		}

		searchbar();
			
		act_book(true);
		?>
		</main>
		}
		}
	</div>
</body>
</html>