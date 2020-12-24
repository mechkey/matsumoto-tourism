<?php
	session_start();
	include './php/navbar.php';
	include './php/head.php';
	logincheck();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css">
	<?php
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
		
		$h1string = '<h1>';
		if (isset($_REQUEST['search']) && $_REQUEST['search'] != '' ) {
			$h1string .= "Search results for '{$_REQUEST['search']}' ";
			
			if ((isset($_REQUEST['search']) && $_REQUEST['search'] != '' ) && (isset($_REQUEST['exclude']) && $_REQUEST['exclude'] != '' )) {
				$h1string .= ", excluding results for '{$_REQUEST['exclude']}'";
			}
		} else if (isset($_REQUEST['exclude']) && $_REQUEST['exclude'] != '' ) {
			$h1string .= "Excluding results for '{$_REQUEST['exclude']}'";
		}

		if (isset($_REQUEST['search']) || isset($_REQUEST['exclude'])) {
			$h1string .= ":</h1>";
			echo $h1string;
		}
		if (!(isset($_REQUEST['search']) || isset($_REQUEST['exclude'])) ) {
			echo '<h1>Showing all activities. Please enter a search term: </h1>';
		}
		

		searchbar();

		if (isset($_REQUEST['search']) && $_REQUEST['search'] != '' )
			act_book(true);
		else if (isset($_REQUEST['exclude']) && $_REQUEST['exclude'] != '' )
			act_book(false,true);
		else if (
				isset($_REQUEST['search'])  && 
				isset($_REQUEST['exclude']) &&
				$_REQUEST['search'] != ''   &&
				$_REQUEST['exclude'] != ''  )
			act_book(true, true);
		?>
		</main>
		}
		}
	</div>
</body>
</html>